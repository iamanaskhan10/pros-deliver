<?php

namespace App\Jobs;

use App\Services\Translation\TranslatorService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

/**
 * TranslateContentJob
 *
 * Queued worker that calls the TranslatorService and stores the result in
 * cache for polling by the frontend. The cache key is passed from the
 * controller so the browser can poll for the result.
 */
class TranslateContentJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries   = 2;
    public int $timeout = 15;

    public function __construct(
        public readonly string  $text,
        public readonly string  $targetLang,
        public readonly string  $cacheKey,
        public readonly ?string $sourceLang = null
    ) {}

    /**
     * Translate the text and store the result in cache.
     */
    public function handle(TranslatorService $translator): void
    {
        try {
            $result = $translator->translate($this->text, $this->targetLang, $this->sourceLang);

            Cache::put($this->cacheKey, [
                'status'     => 'done',
                'translated' => $result['translated'],
                'original'   => $result['original'],
                'cached'     => $result['cached'],
            ], now()->addHours(1));

        } catch (\Throwable $e) {
            Log::error('TranslateContentJob failed', [
                'target' => $this->targetLang,
                'error'  => $e->getMessage(),
            ]);

            Cache::put($this->cacheKey, [
                'status'  => 'failed',
                'message' => __('Translation could not be completed at this time.'),
            ], now()->addMinutes(5));
        }
    }

    /**
     * Handle final failure after all retries.
     */
    public function failed(\Throwable $exception): void
    {
        Cache::put($this->cacheKey, [
            'status'  => 'failed',
            'message' => __('Translation service is currently unavailable.'),
        ], now()->addMinutes(5));
    }
}
