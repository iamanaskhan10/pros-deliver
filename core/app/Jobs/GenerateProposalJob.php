<?php

namespace App\Jobs;

use App\Models\JobPost;
use App\Models\User;
use App\Services\AI\AIProposalGenerator;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class GenerateProposalJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Maximum number of attempts before marking as failed.
     */
    public int $tries = 2;

    /**
     * Timeout in seconds for a single attempt.
     */
    public int $timeout = 45;

    /**
     * Cache key used to store the result for the polling endpoint.
     */
    public string $cacheKey;

    public function __construct(
        public readonly int $jobId,
        public readonly int $freelancerId,
        string $uuid
    ) {
        $this->cacheKey = "ai_proposal_{$uuid}";
    }

    /**
     * Execute the AI proposal generation job.
     */
    public function handle(AIProposalGenerator $generator): void
    {
        try {
            $freelancer = User::findOrFail($this->freelancerId);

            $result = $generator->generate($this->jobId, $freelancer);

            // Store successful result in cache (TTL: 5 minutes for the polling window)
            Cache::put($this->cacheKey, [
                'status' => 'done',
                'data'   => $result,
            ], now()->addMinutes(5));

        } catch (\Exception $e) {
            Log::error('GenerateProposalJob failed', [
                'job_id'        => $this->jobId,
                'freelancer_id' => $this->freelancerId,
                'error'         => $e->getMessage(),
            ]);

            // Store failure so the frontend polling can surface a friendly error
            Cache::put($this->cacheKey, [
                'status'  => 'failed',
                'message' => 'The AI could not generate a proposal at this time. Please try again or write manually.',
            ], now()->addMinutes(5));
        }
    }

    /**
     * Handle a final job failure after all retries are exhausted.
     */
    public function failed(\Throwable $exception): void
    {
        Log::error('GenerateProposalJob permanently failed', [
            'job_id' => $this->jobId,
            'error'  => $exception->getMessage(),
        ]);

        Cache::put($this->cacheKey, [
            'status'  => 'failed',
            'message' => 'The AI service is currently unavailable. Please write your proposal manually.',
        ], now()->addMinutes(5));
    }
}
