<?php

namespace Modules\Chat\Services;

use App\Services\Translation\TranslatorService;

/**
 * TranslationService (Chat Module)
 *
 * A thin wrapper over the shared TranslatorService, scoped to the Chat module.
 * Provides context-aware helpers for chat messages without duplicating logic.
 */
class TranslationService
{
    public function __construct(
        private readonly TranslatorService $core
    ) {}

    /**
     * Translate a single chat message text.
     *
     * @param  string      $text        Raw message content (may include HTML).
     * @param  string      $targetLang  BCP-47 code, e.g. 'en', 'fr', 'ar'.
     * @param  string|null $sourceLang  Auto-detect when null.
     * @return array{translated: string, original: string, cached: bool, detected_lang: string}
     */
    public function translateMessage(string $text, string $targetLang, ?string $sourceLang = null): array
    {
        return $this->core->translate($text, $targetLang, $sourceLang);
    }

    /**
     * Detect the language of a message.
     */
    public function detectLanguage(string $text): string
    {
        return $this->core->detect($text);
    }

    /**
     * Build the cache key for a chat message translation (delegates to core).
     */
    public function buildCacheKey(string $text, string $targetLang, ?string $sourceLang = null): string
    {
        return $this->core->buildCacheKey($text, $targetLang, $sourceLang);
    }
}
