<?php

namespace App\Services\AI;

use App\Models\User;
use App\Services\AI\OpenAIService;
use Illuminate\Support\Facades\Log;

class ProfileEnhancer
{
    private OpenAIService $openAI;

    public function __construct(OpenAIService $openAI)
    {
        $this->openAI = $openAI;
    }

    /**
     * Analyze a freelancer's existing profile data and return
     * an enhanced bio and a list of suggested missing skills.
     *
     * @param  User  $freelancer
     * @return array{enhanced_bio: string, suggested_skills: string[]}
     * @throws \RuntimeException
     */
    public function enhance(User $freelancer): array
    {
        $systemPrompt = $this->buildSystemPrompt();
        $userPrompt   = $this->buildUserPrompt($freelancer);

        $rawOutput = $this->openAI->complete($systemPrompt, $userPrompt);

        Log::info('ProfileEnhancer raw output', ['user_id' => $freelancer->id, 'output' => $rawOutput]);

        return $this->parseAndValidate($rawOutput);
    }

    /**
     * Build the strict JSON system prompt.
     */
    private function buildSystemPrompt(): string
    {
        return <<<PROMPT
You are a professional profile copywriter for a freelance marketplace.
Your task: rewrite a freelancer's bio and suggest missing skills to help them rank higher and win more jobs.

STRICT RULES:
- Output ONLY valid JSON. NEVER use markdown code blocks or backticks.
- JSON keys: enhanced_bio, suggested_skills
- enhanced_bio: A compelling, first-person professional bio (MAX 250 characters). Highlight the freelancer's niche, results, and value. Do NOT use placeholder text.
- suggested_skills: A JSON array of exactly 3 skill name strings the freelancer should add based on their niche. Examples: ["SEO Writing", "Video Editing", "Brand Strategy"]
- Do NOT include any explanation outside the JSON object.
PROMPT;
    }

    /**
     * Build the user prompt from the freelancer's existing profile data.
     */
    private function buildUserPrompt(User $freelancer): string
    {
        $currentBio   = $freelancer->user_introduction?->about ?? 'No bio provided';
        $skills       = $freelancer->freelancer_skill()->first()?->skill ?? 'None listed';
        $hourlyRate   = $freelancer->hourly_rate ? "\${$freelancer->hourly_rate}/hr" : 'Not set';
        $categories   = $freelancer->categories?->pluck('category')->implode(', ') ?? 'Not specified';

        return implode("\n", [
            "Current Bio: {$currentBio}",
            "Listed Skills: {$skills}",
            "Work Categories: {$categories}",
            "Hourly Rate: {$hourlyRate}",
        ]);
    }

    /**
     * Parse and validate the AI JSON response.
     *
     * @throws \RuntimeException on parse failure or missing keys.
     */
    private function parseAndValidate(string $rawOutput): array
    {
        $cleaned = preg_replace('/^```(?:json)?\s*/i', '', trim($rawOutput));
        $cleaned = preg_replace('/\s*```$/', '', $cleaned);

        $parsed = json_decode(trim($cleaned), true);

        if (json_last_error() !== JSON_ERROR_NONE || !is_array($parsed)) {
            throw new \RuntimeException('AI returned invalid JSON for profile enhancement.');
        }

        foreach (['enhanced_bio', 'suggested_skills'] as $key) {
            if (!array_key_exists($key, $parsed)) {
                throw new \RuntimeException("AI response is missing the '{$key}' field.");
            }
        }

        return [
            'enhanced_bio'     => substr(strip_tags(trim((string) ($parsed['enhanced_bio'] ?? ''))), 0, 250),
            'suggested_skills' => array_slice(
                array_map('strip_tags', (array) ($parsed['suggested_skills'] ?? [])),
                0, 3
            ),
        ];
    }
}
