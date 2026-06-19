<?php

namespace App\Jobs;

use App\Models\User;
use App\Services\AI\ProfileEnhancer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class EnhanceProfileJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries   = 2;
    public int $timeout = 45;

    public string $cacheKey;

    public function __construct(
        public readonly int $freelancerId,
        string $uuid
    ) {
        $this->cacheKey = "ai_enhance_{$uuid}";
    }

    /**
     * Call the ProfileEnhancer service and persist results in cache.
     */
    public function handle(ProfileEnhancer $enhancer): void
    {
        try {
            $freelancer = User::findOrFail($this->freelancerId);

            $result = $enhancer->enhance($freelancer);

            Cache::put($this->cacheKey, [
                'status' => 'done',
                'data'   => $result,
            ], now()->addMinutes(5));

        } catch (\Exception $e) {
            Log::error('EnhanceProfileJob failed', [
                'freelancer_id' => $this->freelancerId,
                'error'         => $e->getMessage(),
            ]);

            Cache::put($this->cacheKey, [
                'status'  => 'failed',
                'message' => 'The AI could not enhance your profile at this time. Please try again.',
            ], now()->addMinutes(5));
        }
    }

    /**
     * Final failure after retries are exhausted.
     */
    public function failed(\Throwable $exception): void
    {
        Cache::put($this->cacheKey, [
            'status'  => 'failed',
            'message' => 'The AI profile enhancer is currently unavailable.',
        ], now()->addMinutes(5));
    }
}
