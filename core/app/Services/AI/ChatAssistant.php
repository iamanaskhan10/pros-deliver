<?php

namespace App\Services\AI;

use App\Services\AI\OpenAIService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class ChatAssistant
{
    private OpenAIService $openAI;

    public function __construct(OpenAIService $openAI)
    {
        $this->openAI = $openAI;
    }

    /**
     * Generate 3 short, contextual smart reply suggestions based on
     * recent conversation messages.
     *
     * @param  array  $messages  Recent chat messages, each with 'from' (1=client, 2=freelancer) and 'message'.
     * @param  int    $currentUserId  The ID of the user generating replies (for perspective).
     * @return string[]  Array of exactly 3 reply suggestion strings.
     * @throws \RuntimeException
     */
    public function suggestReplies(array $messages, int $currentUserId): array
    {
        $systemPrompt = $this->buildSystemPrompt();
        $userPrompt   = $this->buildUserPrompt($messages, $currentUserId);

        $rawOutput = $this->openAI->complete($systemPrompt, $userPrompt);

        Log::info('ChatAssistant raw output', ['user_id' => $currentUserId, 'output' => $rawOutput]);

        return $this->parseAndValidate($rawOutput);
    }

    /**
     * Build the strict system-level prompt.
     */
    private function buildSystemPrompt(): string
    {
        return <<<PROMPT
You are an AI assistant helping a freelancer respond professionally to client messages on a marketplace platform.
Your task: read the recent chat conversation and generate exactly 3 short reply suggestions.

STRICT RULES:
- Output ONLY valid JSON. NEVER use markdown code blocks or backticks.
- JSON key: replies (an array of exactly 3 strings)
- Each reply: MAX 120 characters. Professional, friendly, and directly relevant to the last message.
- Do NOT use placeholder text like "[Your Name]" or "[Service]".
- Do NOT include any explanation outside the JSON object.
PROMPT;
    }

    /**
     * Build the user prompt from recent chat context.
     *
     * @param  array  $messages  Array of message objects with 'from' and 'message' keys.
     * @param  int    $currentUserId
     */
    private function buildUserPrompt(array $messages, int $currentUserId): string
    {
        $conversationLines = array_map(function ($msg) use ($currentUserId) {
            $speaker = ((int) $msg['from'] === 2) ? 'Freelancer (you)' : 'Client';
            $text    = strip_tags(trim($msg['message'] ?? ''));
            return "[{$speaker}]: {$text}";
        }, array_slice($messages, -10)); // limit to last 10 messages

        $conversation = implode("\n", $conversationLines);

        return "Recent conversation:\n\n{$conversation}\n\nGenerate 3 professional reply suggestions for the freelancer:";
    }

    /**
     * Parse and validate the AI JSON response.
     *
     * @throws \RuntimeException on parse failure.
     */
    private function parseAndValidate(string $rawOutput): array
    {
        $cleaned = preg_replace('/^```(?:json)?\s*/i', '', trim($rawOutput));
        $cleaned = preg_replace('/\s*```$/', '', $cleaned);

        $parsed = json_decode(trim($cleaned), true);

        if (json_last_error() !== JSON_ERROR_NONE || !is_array($parsed)) {
            throw new \RuntimeException('AI returned invalid JSON for smart replies.');
        }

        if (!isset($parsed['replies']) || !is_array($parsed['replies'])) {
            throw new \RuntimeException("AI response is missing the 'replies' field.");
        }

        return array_map(function ($reply) {
            return substr(strip_tags(trim((string) $reply)), 0, 120);
        }, array_slice($parsed['replies'], 0, 3));
    }
}
