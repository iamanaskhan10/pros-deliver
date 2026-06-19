<?php

namespace App\Services\AI;

use App\Models\JobPost;
use App\Models\User;
use App\Services\AI\OpenAIService;
use Illuminate\Support\Facades\Log;

class AIProposalGenerator
{
    private OpenAIService $openAI;

    public function __construct(OpenAIService $openAI)
    {
        $this->openAI = $openAI;
    }

    /**
     * Generate a structured proposal from a job post and freelancer profile.
     *
     * @param  int  $jobId           The ID of the job being applied to.
     * @param  User $freelancer      The authenticated freelancer model.
     * @return array{
     *   proposal: string,
     *   suggested_price: int,
     *   estimated_days: string
     * }
     * @throws \RuntimeException On AI or parsing failure.
     */
    public function generate(int $jobId, User $freelancer): array
    {
        $job = JobPost::with('job_skills')->find($jobId);

        if (!$job) {
            throw new \RuntimeException('Job post not found.');
        }

        $systemPrompt = $this->buildSystemPrompt();
        $userPrompt   = $this->buildUserPrompt($job, $freelancer);

        $rawOutput = $this->openAI->complete($systemPrompt, $userPrompt);

        Log::info('AIProposalGenerator raw output', ['job_id' => $jobId, 'output' => $rawOutput]);

        return $this->parseAndValidate($rawOutput);
    }

    /**
     * Build the system-level instruction prompt.
     */
    private function buildSystemPrompt(): string
    {
        return <<<PROMPT
You are an expert freelance proposal writer for a professional marketplace.
Your task: given a job post and a freelancer profile, write a winning proposal.

STRICT RULES:
- Output ONLY valid JSON. NEVER use markdown code blocks or backticks.
- JSON keys: proposal, suggested_price, estimated_days
- proposal: A professional, persuasive cover letter (MAX 900 characters). Address the client's specific needs. Do NOT use placeholder text like "[Your Name]". Sound confident and results-driven.
- suggested_price: An integer representing the recommended bid price in USD. Must be a reasonable number relative to the job budget.
- estimated_days: A realistic delivery timeframe string. Examples: "3 Days", "1 Week", "2 Weeks", "1 Month".
- Do NOT include any explanation outside the JSON object.
PROMPT;
    }

    /**
     * Build the user-facing prompt containing job and freelancer context.
     */
    private function buildUserPrompt(JobPost $job, User $freelancer): string
    {
        $skills = $job->job_skills->pluck('skill')->implode(', ');

        // Load freelancer introduction if it exists
        $introduction = $freelancer->user_introduction?->about ?? null;
        $freelancerSkills = $freelancer->user_skills?->pluck('skill.skill')->implode(', ') ?? null;

        $jobContext = implode("\n", array_filter([
            "Job Title: {$job->title}",
            "Job Description: " . strip_tags($job->description),
            "Budget: \${$job->budget}",
            "Duration: {$job->duration}",
            $skills ? "Required Skills: {$skills}" : null,
        ]));

        $freelancerContext = implode("\n", array_filter([
            "Freelancer Name: {$freelancer->first_name} {$freelancer->last_name}",
            $introduction ? "About: {$introduction}" : null,
            $freelancerSkills ? "Skills: {$freelancerSkills}" : null,
            $freelancer->hourly_rate ? "Hourly Rate: \${$freelancer->hourly_rate}/hr" : null,
        ]));

        return "Generate a winning proposal for this job.\n\nJOB DETAILS:\n{$jobContext}\n\nFREELANCER PROFILE:\n{$freelancerContext}";
    }

    /**
     * Parse the raw AI output and validate its structure.
     *
     * @throws \RuntimeException On invalid JSON or missing required keys.
     */
    private function parseAndValidate(string $rawOutput): array
    {
        // Strip any accidental markdown code fences
        $cleaned = preg_replace('/^```(?:json)?\s*/i', '', trim($rawOutput));
        $cleaned = preg_replace('/\s*```$/', '', $cleaned);

        $parsed = json_decode(trim($cleaned), true);

        if (json_last_error() !== JSON_ERROR_NONE || !is_array($parsed)) {
            throw new \RuntimeException('AI returned invalid JSON. Please try again.');
        }

        $requiredKeys = ['proposal', 'suggested_price', 'estimated_days'];
        foreach ($requiredKeys as $key) {
            if (!array_key_exists($key, $parsed)) {
                throw new \RuntimeException("AI response is missing the '{$key}' field.");
            }
        }

        return [
            'proposal'        => $this->sanitizeString((string) ($parsed['proposal'] ?? ''), 900),
            'suggested_price' => max(1, (int) ($parsed['suggested_price'] ?? 0)),
            'estimated_days'  => $this->sanitizeString((string) ($parsed['estimated_days'] ?? ''), 50),
        ];
    }

    /**
     * Sanitize and trim a string to a maximum length.
     */
    private function sanitizeString(string $value, int $maxLength): string
    {
        return substr(strip_tags(trim($value)), 0, $maxLength);
    }
}
