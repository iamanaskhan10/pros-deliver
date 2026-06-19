<?php

namespace App\Services\AI;

use App\Models\JobPost;
use App\Models\User;
use App\Services\AI\OpenAIService;
use Illuminate\Support\Facades\Log;

/**
 * AutoOutreachService
 *
 * Generates a personalized, professional outreach message for a client
 * to send to a specific freelancer after the AI matching analysis.
 *
 * Uses OpenAI for natural language generation. Heavy call — intended
 * to be used selectively, not in bulk.
 */
class AutoOutreachService
{
    private OpenAIService $openAI;

    // Max characters for the generated message
    private const MAX_MESSAGE_LENGTH = 600;

    public function __construct(OpenAIService $openAI)
    {
        $this->openAI = $openAI;
    }

    /**
     * Generate a personalized outreach message for a specific freelancer.
     *
     * @param  int  $jobId          The campaign/job post ID
     * @param  int  $freelancerId   The target freelancer's user ID
     * @return string               The generated message text
     *
     * @throws \RuntimeException    On AI failure or missing data
     */
    public function generate(int $jobId, int $freelancerId): string
    {
        $job        = JobPost::with('job_skills')->find($jobId);
        $freelancer = User::with(['user_introduction', 'freelancer_skill'])->find($freelancerId);

        if (!$job) {
            throw new \RuntimeException("Job #{$jobId} not found.");
        }
        if (!$freelancer) {
            throw new \RuntimeException("Freelancer #{$freelancerId} not found.");
        }

        $systemPrompt = <<<PROMPT
You are a professional business communication assistant for a freelance marketplace.
Your task: write a concise, warm, and professional outreach message from a CLIENT to a FREELANCER.
Rules:
- Maximum 4 sentences
- Mention the job/project name specifically
- Reference one or two specific skills or strengths of the freelancer
- End with a clear, friendly call to action (e.g., "I'd love to discuss further")
- Sound human and natural, NOT robotic
- Output ONLY the message text, no subject line, no labels, no quotes
PROMPT;

        $freelancerName  = $freelancer->first_name ?? 'there';
        $freelancerSkill = $freelancer->freelancer_skill()->first()?->skill ?? 'your expertise';
        $freelancerBio   = substr($freelancer->user_introduction?->about ?? 'Not provided', 0, 200);
        $jobSkills       = $job->job_skills->pluck('skill')->implode(', ') ?: 'Not specified';
        $jobTitle        = $job->title;
        $jobDesc         = substr(strip_tags($job->description ?? ''), 0, 300);

        $userPrompt = implode("\n", [
            "Client's Job Title: {$jobTitle}",
            "Job Description (excerpt): {$jobDesc}",
            "Required Skills: {$jobSkills}",
            "",
            "Freelancer Name: {$freelancerName}",
            "Freelancer Skills: {$freelancerSkill}",
            "Freelancer Bio (excerpt): {$freelancerBio}",
            "",
            "Generate the outreach message now:",
        ]);

        try {
            $raw = $this->openAI->complete($systemPrompt, $userPrompt);
            return substr(trim($raw), 0, self::MAX_MESSAGE_LENGTH);
        } catch (\Exception $e) {
            Log::warning('AutoOutreachService generation failed', [
                'job_id'        => $jobId,
                'freelancer_id' => $freelancerId,
                'error'         => $e->getMessage(),
            ]);

            throw new \RuntimeException('Could not generate outreach message: ' . $e->getMessage());
        }
    }
}
