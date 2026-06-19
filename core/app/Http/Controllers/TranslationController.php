<?php

namespace App\Http\Controllers;

use App\Jobs\TranslateContentJob;
use App\Services\Translation\TranslatorService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

/**
 * TranslationController
 *
 * Provides two REST endpoints:
 *   POST /ai/translate        -> Dispatches job, returns cache_key for polling.
 *   GET  /ai/translate/{key}  -> Returns the completed translation or status.
 *
 * For short texts (<= 500 chars), translation is performed synchronously to
 * avoid polling latency. Longer texts are queued.
 */
class TranslationController extends Controller
{
    public function __construct(
        private readonly TranslatorService $translator
    ) {}

    /**
     * Dispatch a translation request and return a polling key.
     */
    public function translate(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'text'        => 'required|string|max:5000',
            'target_lang' => 'required|string|size:2',
            'source_lang' => 'nullable|string|size:2',
        ]);

        $text       = $validated['text'];
        $targetLang = $validated['target_lang'];
        $sourceLang = $validated['source_lang'] ?? null;

        // Check cache first — return instantly if we already have the result
        $cacheKey = $this->translator->buildCacheKey($text, $targetLang, $sourceLang);

        if (Cache::has($cacheKey)) {
            $cached = Cache::get($cacheKey);
            return response()->json([
                'status'     => 'done',
                'translated' => $cached['translated'],
                'original'   => $cached['original'] ?? $text,
                'cached'     => true,
                'poll_key'   => $cacheKey,
            ]);
        }

        // For short texts, translate synchronously (faster UX)
        if (mb_strlen($text) <= 500) {
            try {
                $result = $this->translator->translate($text, $targetLang, $sourceLang);
                return response()->json([
                    'status'     => 'done',
                    'translated' => $result['translated'],
                    'original'   => $result['original'],
                    'cached'     => $result['cached'],
                    'poll_key'   => $cacheKey,
                ]);
            } catch (\Throwable) {
                // Fall through to async path on error
            }
        }

        // Dispatch queue job for longer texts
        $pollKey = 'translate_poll_' . Str::uuid();

        TranslateContentJob::dispatch($text, $targetLang, $pollKey, $sourceLang);

        return response()->json([
            'status'   => 'processing',
            'poll_key' => $pollKey,
        ]);
    }

    /**
     * Poll for a queued translation result.
     */
    public function status(string $key): JsonResponse
    {
        // Sanitize key to prevent cache injection
        if (!preg_match('/^translate_[a-zA-Z0-9_\-]+$/', $key)) {
            return response()->json(['status' => 'error', 'message' => 'Invalid key.'], 400);
        }

        $result = Cache::get($key);

        if (!$result) {
            return response()->json(['status' => 'processing']);
        }

        return response()->json($result);
    }
}
