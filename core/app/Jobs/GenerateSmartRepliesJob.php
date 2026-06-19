<?php

namespace App\Jobs;

use App\Services\AI\ChatAssistant;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class GenerateSmartRepliesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries   = 2;
    public int $timeout = 30;

    public string $cacheKey;

    public function __construct(
        public readonly array $messages,
        public readonly int   $userId,
        string $uuid
    ) {
        $this->cacheKey = "ai_smart_reply_{$uuid}";
    }

    /**
     * Call the ChatAssistant service and cache the reply suggestions.
     */
    public function handle(ChatAssistant $assistant): void
    {
        try {
            $replies = $assistant->suggestReplies($this->messages, $this->userId);

            Cache::put($this->cacheKey, [
                'status'  => 'done',
                'replies' => $replies,
            ], now()->addMinutes(3));

        } catch (\Exception $e) {
            Log::error('GenerateSmartRepliesJob failed', [
                'user_id' => $this->userId,
                'error'   => $e->getMessage(),
            ]);

            Cache::put($this->cacheKey, [
                'status'  => 'failed',
                'message' => 'Smart replies could not be generated at this time.',
            ], now()->addMinutes(3));
        }
    }

    /**
     * Final failure after all retries.
     */
    public function failed(\Throwable $exception): void
    {
        Cache::put($this->cacheKey, [
            'status'  => 'failed',
            'message' => 'The AI Smart Reply service is currently unavailable.',
        ], now()->addMinutes(3));
    }
}
