<?php

namespace App\Services\Translation;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * TranslatorService
 *
 * Core translation layer. Supports Google Cloud Translate v2 and Azure
 * Cognitive Translator. Translation logic is fully isolated here and must
 * not be mixed into AI or Chat services.
 *
 * Credentials are loaded exclusively from config/ai.php (which reads .env).
 * Results are cached for 24 hours by default to avoid redundant API calls.
 */
class TranslatorService
{
    /** Cache TTL in seconds. */
    private int $cacheTtl;

    /** Translation provider: 'google' or 'azure'. */
    private string $provider;

    public function __construct()
    {
        $config          = config('ai.translation');
        $this->provider  = $config['provider'] ?? 'google';
        $this->cacheTtl  = ($config['cache_ttl_hours'] ?? 24) * 3600;
    }

    /**
     * Translate text into the target language.
     * Returns the cached result when available.
     * Falls back to the original text on API failure.
     *
     * @param  string  $text         The source text to translate.
     * @param  string  $targetLang   BCP-47 language code, e.g. 'en', 'fr', 'ar'.
     * @param  string|null  $sourceLang  Auto-detect when null.
     * @return array{translated: string, original: string, cached: bool, detected_lang: string}
     */
    public function translate(string $text, string $targetLang, ?string $sourceLang = null): array
    {
        $text = trim($text);

        // Return immediately for empty input
        if (empty($text)) {
            return $this->buildResult($text, $text, true, $sourceLang ?? '');
        }

        $cacheKey = $this->buildCacheKey($text, $targetLang, $sourceLang);

        // Serve from cache when available
        if (Cache::has($cacheKey)) {
            $cached = Cache::get($cacheKey);
            $cached['cached'] = true;
            return $cached;
        }

        try {
            $result = match ($this->provider) {
                'azure'  => $this->callAzure($text, $targetLang, $sourceLang),
                default  => $this->callGoogle($text, $targetLang, $sourceLang),
            };

            Cache::put($cacheKey, $result, $this->cacheTtl);
            return $result;

        } catch (\Throwable $e) {
            Log::error('TranslatorService: translation failed', [
                'provider' => $this->provider,
                'target'   => $targetLang,
                'error'    => $e->getMessage(),
            ]);

            // Graceful fallback: return original text
            return $this->buildResult($text, $text, false, $sourceLang ?? '');
        }
    }

    /**
     * Build a deterministic cache key for this translation request.
     */
    public function buildCacheKey(string $text, string $targetLang, ?string $sourceLang): string
    {
        return 'translate_' . md5($text . '|' . $targetLang . '|' . ($sourceLang ?? 'auto'));
    }

    /**
     * Detect the language of a text string.
     * Returns a BCP-47 code or 'unknown' on failure.
     */
    public function detect(string $text): string
    {
        $text = trim($text);
        if (empty($text)) {
            return 'unknown';
        }

        try {
            return match ($this->provider) {
                'azure'  => $this->detectAzure($text),
                default  => $this->detectGoogle($text),
            };
        } catch (\Throwable $e) {
            Log::warning('TranslatorService: language detection failed', ['error' => $e->getMessage()]);
            return 'unknown';
        }
    }

    // -------------------------------------------------------------------------
    // Google Cloud Translate v2
    // -------------------------------------------------------------------------

    /**
     * Call Google Cloud Translate v2.
     */
    private function callGoogle(string $text, string $targetLang, ?string $sourceLang): array
    {
        $config = config('ai.translation');
        $apiKey = $config['google_key'] ?? '';

        if (empty($apiKey)) {
            throw new \RuntimeException('GOOGLE_TRANSLATE_API_KEY is not configured.');
        }

        $payload = [
            'q'      => $text,
            'target' => $targetLang,
            'format' => 'html',
        ];

        if (!empty($sourceLang)) {
            $payload['source'] = $sourceLang;
        }

        $response = Http::timeout(10)
            ->get($config['google_endpoint'], array_merge($payload, ['key' => $apiKey]));

        if (!$response->successful()) {
            throw new \RuntimeException('Google Translate API error: ' . $response->status());
        }

        $body         = $response->json();
        $translation  = $body['data']['translations'][0]['translatedText'] ?? $text;
        $detectedLang = $body['data']['translations'][0]['detectedSourceLanguage'] ?? ($sourceLang ?? '');

        return $this->buildResult($text, $translation, false, $detectedLang);
    }

    /**
     * Detect language via Google Cloud Translate.
     */
    private function detectGoogle(string $text): string
    {
        $config = config('ai.translation');
        $apiKey = $config['google_key'] ?? '';

        if (empty($apiKey)) {
            return 'unknown';
        }

        $response = Http::timeout(10)
            ->get(rtrim($config['google_endpoint'], '/') . '/detect', [
                'q'   => $text,
                'key' => $apiKey,
            ]);

        if (!$response->successful()) {
            return 'unknown';
        }

        return $response->json('data.detections.0.0.language') ?? 'unknown';
    }

    // -------------------------------------------------------------------------
    // Azure Cognitive Translator v3
    // -------------------------------------------------------------------------

    /**
     * Call Azure Cognitive Translator v3.
     */
    private function callAzure(string $text, string $targetLang, ?string $sourceLang): array
    {
        $config = config('ai.translation');
        $apiKey = $config['azure_key'] ?? '';
        $region = $config['azure_region'] ?? 'eastus';

        if (empty($apiKey)) {
            throw new \RuntimeException('AZURE_TRANSLATE_KEY is not configured.');
        }

        // Use resource-specific endpoint when provided (Azure AI Foundry / multi-service)
        $baseEndpoint = !empty($config['azure_endpoint_custom'])
            ? rtrim($config['azure_endpoint_custom'], '/') . '/translator/text/v3.0/translate'
            : $config['azure_endpoint'];

        $queryParams = ['api-version' => '3.0', 'to' => $targetLang];
        if (!empty($sourceLang)) {
            $queryParams['from'] = $sourceLang;
        }

        $jsonBody = json_encode([['Text' => $text]]);
        $headers  = [
            'Ocp-Apim-Subscription-Key: ' . $apiKey,
            'Ocp-Apim-Subscription-Region: ' . $region,
            'Content-Type: application/json',
        ];

        $rawResponse = $this->curlPost($baseEndpoint . '?' . http_build_query($queryParams), $jsonBody, $headers);
        $body        = json_decode($rawResponse, true);

        // Try Key 2 as fallback if Key 1 returned 401
        if (!is_array($body) || isset($body['error'])) {
            $apiKey2 = $config['azure_key2'] ?? '';
            if (!empty($apiKey2) && $apiKey2 !== $apiKey) {
                $headers2    = [
                    'Ocp-Apim-Subscription-Key: ' . $apiKey2,
                    'Ocp-Apim-Subscription-Region: ' . $region,
                    'Content-Type: application/json',
                ];
                $rawResponse = $this->curlPost($baseEndpoint . '?' . http_build_query($queryParams), $jsonBody, $headers2);
                $body        = json_decode($rawResponse, true);
            }
        }

        if (!is_array($body) || isset($body['error'])) {
            throw new \RuntimeException('Azure Translator API error: ' . ($body['error']['message'] ?? 'Unknown'));
        }

        $translation  = $body[0]['translations'][0]['text'] ?? $text;
        $detectedLang = $body[0]['detectedLanguage']['language'] ?? ($sourceLang ?? '');

        return $this->buildResult($text, $translation, false, $detectedLang);
    }

    /**
     * Detect language via Azure.
     */
    private function detectAzure(string $text): string
    {
        $config   = config('ai.translation');
        $apiKey   = $config['azure_key'] ?? '';
        $region   = $config['azure_region'] ?? 'eastus';

        if (empty($apiKey)) {
            return 'unknown';
        }

        $jsonBody = json_encode([['Text' => $text]]);
        $rawResponse = $this->curlPost(
            $config['azure_endpoint'] . '?api-version=3.0&to=en',
            $jsonBody,
            [
                'Ocp-Apim-Subscription-Key: ' . $apiKey,
                'Ocp-Apim-Subscription-Region: ' . $region,
                'Content-Type: application/json',
            ]
        );

        $body = json_decode($rawResponse, true);
        if (!is_array($body)) {
            return 'unknown';
        }

        return $body[0]['detectedLanguage']['language'] ?? 'unknown';
    }

    // -------------------------------------------------------------------------
    // Helpers
    // -------------------------------------------------------------------------

    /**
     * Build a standardized result array.
     */
    private function buildResult(string $original, string $translated, bool $cached, string $detectedLang): array
    {
        return [
            'original'      => $original,
            'translated'    => $translated,
            'cached'        => $cached,
            'detected_lang' => $detectedLang,
        ];
    }

    /**
     * Raw cURL POST that disables SSL peer verification.
     * Required for Azure on Windows local dev environments where the system
     * CA bundle does not include the intermediate certificate used by Azure.
     *
     * @param  string    $url
     * @param  string    $jsonBody
     * @param  string[]  $headers
     * @return string    Raw response body
     * @throws \RuntimeException on cURL error
     */
    private function curlPost(string $url, string $jsonBody, array $headers): string
    {
        $ch = curl_init($url);

        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => $jsonBody,
            CURLOPT_HTTPHEADER     => $headers,
            CURLOPT_TIMEOUT        => 15,
            CURLOPT_SSL_VERIFYPEER => false, // Bypass self-signed CA chain on local dev
            CURLOPT_SSL_VERIFYHOST => 0,
        ]);

        $response = curl_exec($ch);
        $error    = curl_error($ch);
        curl_close($ch);

        if ($response === false) {
            throw new \RuntimeException('cURL error calling Azure Translator: ' . $error);
        }

        return $response;
    }
}
