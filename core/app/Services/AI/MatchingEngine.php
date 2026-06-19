<?php

namespace App\Services\AI;

use App\Models\JobPost;
use App\Models\JobProposal;
use App\Models\User;
use App\Services\AI\OpenAIService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class MatchingEngine
{
    private OpenAIService $openAI;

    // Scoring weights — must sum to 1.0
    private const WEIGHT_SKILLS    = 0.35;
    private const WEIGHT_BUDGET    = 0.25;
    private const WEIGHT_DELIVERY  = 0.20;
    private const WEIGHT_RATING    = 0.10;
    private const WEIGHT_PROFILE   = 0.10;

    // How many top candidates get AI reasoning
    private const AI_REASONING_LIMIT = 5;

    public function __construct(OpenAIService $openAI)
    {
        $this->openAI = $openAI;
    }

    /**
     * Run the full hybrid analysis pipeline:
     * Stage 1 — Rule-based scoring for ALL proposals.
     * Stage 2 — AI reasoning for the top N candidates only.
     *
     * @param  int  $jobId
     * @return array  Sorted ranked list with optional AI reasoning.
     */
    public function analyze(int $jobId): array
    {
        $job = JobPost::with(['job_skills'])->find($jobId);

        if (!$job) {
            throw new \RuntimeException("Job #{$jobId} not found.");
        }

        $proposals = JobProposal::with([
            'freelancer',
            'freelancer.freelancer_skill',
            'freelancer.user_introduction',
        ])->where('job_id', $jobId)->get();

        if ($proposals->isEmpty()) {
            return [];
        }

        // Stage 1: Score every proposal with rule-based logic
        $scored = $proposals->map(function (JobProposal $proposal) use ($job) {
            return [
                'proposal_id'   => $proposal->id,
                'freelancer_id' => $proposal->freelancer_id,
                'name'          => optional($proposal->freelancer)->full_name ?? 'Unknown',
                'amount'        => $proposal->amount,
                'duration'      => $proposal->duration,
                'cover_letter'  => $proposal->cover_letter,
                'rule_score'    => $this->computeRuleScore($job, $proposal),
                'ai_reasoning'  => null,
            ];
        })->sortByDesc('rule_score')->values()->toArray();

        // Stage 2: AI reasoning for top candidates only
        $topSlice = array_slice($scored, 0, self::AI_REASONING_LIMIT);
        foreach ($topSlice as $index => $candidate) {
            try {
                $proposal   = $proposals->firstWhere('id', $candidate['proposal_id']);
                $freelancer = $proposal?->freelancer;
                $scored[$index]['ai_reasoning'] = $this->generateReasoning($job, $proposal, $freelancer);
            } catch (\Exception $e) {
                Log::warning("MatchingEngine AI reasoning failed for proposal #{$candidate['proposal_id']}", [
                    'error' => $e->getMessage(),
                ]);
                $scored[$index]['ai_reasoning'] = 'AI analysis unavailable for this candidate.';
            }
        }

        return $scored;
    }

    /**
     * Stage 1: Compute a 0-100 composite rule-based score for one proposal.
     */
    private function computeRuleScore(JobPost $job, JobProposal $proposal): float
    {
        $freelancer = $proposal->freelancer;

        return round(
            ($this->skillScore($job, $freelancer)    * self::WEIGHT_SKILLS)  +
            ($this->budgetScore($job, $proposal)     * self::WEIGHT_BUDGET)  +
            ($this->deliveryScore($job, $proposal)   * self::WEIGHT_DELIVERY) +
            ($this->ratingScore($freelancer)         * self::WEIGHT_RATING)  +
            ($this->profileScore($freelancer)        * self::WEIGHT_PROFILE),
            2
        );
    }

    /**
     * Skill overlap: percentage of required job skills the freelancer has.
     */
    private function skillScore(JobPost $job, ?User $freelancer): float
    {
        if (!$freelancer) {
            return 0.0;
        }

        $requiredSkills = $job->job_skills->pluck('skill')->map('strtolower')->toArray();

        if (empty($requiredSkills)) {
            return 100.0; // No specific skills required — everyone qualifies
        }

        $freelancerSkillRecord = $freelancer->freelancer_skill()->first();
        if (!$freelancerSkillRecord || empty($freelancerSkillRecord->skill)) {
            return 0.0;
        }

        // Freelancer skills may be stored as comma-separated text or related records
        $freelancerSkills = array_map('strtolower', array_map('trim', explode(',', $freelancerSkillRecord->skill)));

        $matched = count(array_intersect($requiredSkills, $freelancerSkills));

        return ($matched / count($requiredSkills)) * 100;
    }

    /**
     * Budget alignment: how well the bid matches the posted budget.
     * Perfect score if bid == budget; decays linearly up to 50% deviation.
     */
    private function budgetScore(JobPost $job, JobProposal $proposal): float
    {
        $budget = (float) ($job->budget ?? 0);
        $bid    = (float) ($proposal->amount ?? 0);

        if ($budget <= 0 || $bid <= 0) {
            return 50.0; // Neutral when we can't compare
        }

        $deviation = abs($bid - $budget) / $budget;

        return max(0.0, 100.0 - ($deviation * 200));
    }

    /**
     * Delivery time score: lower duration = better, capped at job's own duration.
     */
    private function deliveryScore(JobPost $job, JobProposal $proposal): float
    {
        // Convert duration strings to approximate days for comparison
        $proposedDays = $this->durationToDays((string) ($proposal->duration ?? ''));
        $jobDays      = $this->durationToDays((string) ($job->duration ?? ''));

        if ($proposedDays <= 0 || $jobDays <= 0) {
            return 50.0;
        }

        if ($proposedDays <= $jobDays) {
            return 100.0;
        }

        // Penalise proportionally if delivery exceeds the job's requested duration
        $overrun = ($proposedDays - $jobDays) / $jobDays;

        return max(0.0, 100.0 - ($overrun * 100));
    }

    /**
     * Freelancer rating score: 0-100 mapped from 0-5 stars.
     */
    private function ratingScore(?User $freelancer): float
    {
        if (!$freelancer) {
            return 0.0;
        }

        $avg = (float) freelancer_rating($freelancer->id, true);

        return ($avg / 5) * 100;
    }

    /**
     * Profile completeness: bio + skills + hourly rate each contribute.
     */
    private function profileScore(?User $freelancer): float
    {
        if (!$freelancer) {
            return 0.0;
        }

        $score = 0.0;

        if ($freelancer->user_introduction?->about) {
            $score += 40;
        }

        if ($freelancer->freelancer_skill()->exists()) {
            $score += 40;
        }

        if ($freelancer->hourly_rate > 0) {
            $score += 20;
        }

        return $score;
    }

    /**
     * Stage 2: Ask the AI to write a short qualitative reasoning paragraph
     * for a top-ranked candidate.
     */
    private function generateReasoning(JobPost $job, ?JobProposal $proposal, ?User $freelancer): string
    {
        if (!$proposal || !$freelancer) {
            return 'Candidate profile data is incomplete.';
        }

        $systemPrompt = <<<PROMPT
You are a talent analyst for a professional freelance marketplace.
Your task: given a job post and a freelancer's proposal, write ONE concise paragraph (MAX 200 characters) explaining WHY this freelancer is a strong or weak match.
Output ONLY the paragraph. No labels, no JSON, no lists.
PROMPT;

        $skills     = $freelancer->freelancer_skill()->first()?->skill ?? 'Not specified';
        $bio        = $freelancer->user_introduction?->about ?? 'No bio provided';
        $coverLetter = strip_tags($proposal->cover_letter ?? '');

        $userPrompt = implode("\n", [
            "Job Title: {$job->title}",
            "Job Description: " . strip_tags($job->description),
            "Budget: \${$job->budget}",
            "",
            "Freelancer Skills: {$skills}",
            "Freelancer Bio: {$bio}",
            "Their Bid: \${$proposal->amount}, Delivery: {$proposal->duration}",
            "Cover Letter (excerpt): " . substr($coverLetter, 0, 300),
        ]);

        $raw = $this->openAI->complete($systemPrompt, $userPrompt);

        return substr(strip_tags(trim($raw)), 0, 200);
    }

    /**
     * Convert a duration string like "3 Days", "1 Week", "1 Month"
     * into an approximate integer number of days.
     */
    private function durationToDays(string $duration): int
    {
        $duration = strtolower(trim($duration));

        if (preg_match('/(\d+)\s*day/', $duration, $m)) {
            return (int) $m[1];
        }
        if (preg_match('/(\d+)\s*week/', $duration, $m)) {
            return (int) $m[1] * 7;
        }
        if (preg_match('/(\d+)\s*month/', $duration, $m)) {
            return (int) $m[1] * 30;
        }
        if (str_contains($duration, 'less than a month')) {
            return 25;
        }
        if (str_contains($duration, 'more than a month')) {
            return 45;
        }

        return 0; // Unknown — neutral
    }
}
