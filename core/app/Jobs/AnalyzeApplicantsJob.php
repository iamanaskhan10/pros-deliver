<?php

namespace App\Jobs;

use App\Services\AI\MatchingEngine;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class AnalyzeApplicantsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Maximum number of attempts before the job is marked as failed.
     */
    public int $tries = 2;

    /**
     * Per-attempt timeout in seconds (AI calls can be slow for top-5 reasoning).
     */
    public int $timeout = 90;

    /**
     * Cache key for polling communication with the frontend.
     */
    public string $cacheKey;

    public function __construct(
        public readonly int $jobId,
        string $uuid
    ) {
        $this->cacheKey = "ai_match_{$uuid}";
    }

    /**
     * Run the full hybrid analysis and persist the ranked result in cache.
     */
    public function handle(MatchingEngine $engine): void
    {
        try {
            $ranked = $engine->analyze($this->jobId);

            Cache::put($this->cacheKey, [
                'status' => 'done',
                'data'   => $ranked,
            ], now()->addMinutes(10));

        } catch (\Exception $e) {
            Log::error('AnalyzeApplicantsJob failed', [
                'job_id' => $this->jobId,
                'error'  => $e->getMessage(),
            ]);

            Cache::put($this->cacheKey, [
                'status'  => 'failed',
                'message' => 'AI analysis could not be completed at this time. Please try again.',
            ], now()->addMinutes(5));
        }
    }

    /**
     * Final failure after all retries are exhausted.
     */
    public function failed(\Throwable $exception): void
    {
        Log::error('AnalyzeApplicantsJob permanently failed', [
            'job_id' => $this->jobId,
            'error'  => $exception->getMessage(),
        ]);

        Cache::put($this->cacheKey, [
            'status'  => 'failed',
            'message' => 'The AI analysis service is currently unavailable.',
        ], now()->addMinutes(5));
    }
}
