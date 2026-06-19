<?php

namespace App\Services\AI;

use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OpenAIService
{
    private string $apiKey;
    private string $model;
    private int    $maxTokens;
    private float  $temperature;
    private string $endpoint;

    public function __construct()
    {
        $this->apiKey      = config('ai.openai.key');
        $this->model       = config('ai.openai.model', 'gpt-4o-mini');
        $this->maxTokens   = config('ai.openai.max_tokens', 600);
        $this->temperature = config('ai.openai.temperature', 0.5);
        $this->endpoint    = config('ai.openai.endpoint', 'https://api.openai.com/v1/responses');
    }

    /**
     * Send a prompt to OpenAI /v1/responses endpoint and return the text output.
     *
     * @param  string  $systemPrompt  The system-level instruction.
     * @param  string  $userPrompt    The user's actual input.
     * @return string                 Raw text output from the model.
     *
     * @throws \RuntimeException When API key is missing or the request fails.
     */
    public function complete(string $systemPrompt, string $userPrompt): string
    {
        if (empty($this->apiKey)) {
            throw new \RuntimeException('OpenAI API key is not configured. Add OPENAI_API_KEY to your .env file.');
        }

        try {
            $response = Http::withToken($this->apiKey)
                ->withoutVerifying()
                ->timeout(30)
                ->post($this->endpoint, [
                    'model'       => $this->model,
                    'max_output_tokens' => $this->maxTokens,
                    'temperature' => $this->temperature,
                    'input'       => [
                        [
                            'role'    => 'system',
                            'content' => $systemPrompt,
                        ],
                        [
                            'role'    => 'user',
                            'content' => $userPrompt,
                        ],
                    ],
                ]);

            $response->throw();

            $body = $response->json();

            // /v1/responses returns output as an array of content blocks
            $outputText = $body['output'][0]['content'][0]['text']
                ?? $body['output_text']
                ?? null;

            if (empty($outputText)) {
                throw new \RuntimeException('OpenAI returned an empty response body.');
            }

            return $outputText;

        } catch (RequestException $e) {
            Log::error('OpenAIService HTTP error', [
                'status'  => $e->response->status(),
                'body'    => $e->response->body(),
            ]);
            throw new \RuntimeException('OpenAI API request failed: ' . $e->getMessage());
        } catch (\RuntimeException $e) {
            throw $e;
        } catch (\Exception $e) {
            Log::error('OpenAIService unexpected error', ['message' => $e->getMessage()]);
            throw new \RuntimeException('An unexpected error occurred while contacting the AI service.');
        }
    }
}
