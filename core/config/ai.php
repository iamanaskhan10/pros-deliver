<?php

return [

    /*
    |--------------------------------------------------------------------------
    | OpenAI Configuration
    |--------------------------------------------------------------------------
    | All sensitive values are read from .env — never hardcoded here.
    */
    'openai' => [
        'key'         => env('OPENAI_API_KEY'),
        'model'       => env('OPENAI_MODEL', 'gpt-4o-mini'),
        'max_tokens'  => (int) env('OPENAI_MAX_TOKENS', 600),
        'temperature' => (float) env('OPENAI_TEMPERATURE', 0.5),
        'endpoint'    => 'https://api.openai.com/v1/responses',
    ],

    /*
    |--------------------------------------------------------------------------
    | Google Cloud Translation Configuration
    |--------------------------------------------------------------------------
    | Credentials are always read from .env. Set GOOGLE_TRANSLATE_API_KEY
    | to enable AI-powered translation across Chat, Jobs, and Proposals.
    */
    'translation' => [
        'provider'          => env('TRANSLATION_PROVIDER', 'google'), // 'google' or 'azure'
        'google_key'        => env('GOOGLE_TRANSLATE_API_KEY'),
        'azure_key'         => env('AZURE_TRANSLATE_KEY'),
        'azure_key2'        => env('AZURE_TRANSLATE_KEY2'),
        'azure_region'      => env('AZURE_TRANSLATE_REGION', 'eastus'),
        // If set, overrides the global endpoint (required for Azure AI Foundry / multi-service resources)
        'azure_endpoint_custom' => env('AZURE_TRANSLATE_ENDPOINT'),
        'default_target'    => env('TRANSLATION_DEFAULT_LANG', 'en'),
        'cache_ttl_hours'   => (int) env('TRANSLATION_CACHE_TTL', 24),
        'google_endpoint'   => 'https://translation.googleapis.com/language/translate/v2',
        'azure_endpoint'    => 'https://api.cognitive.microsofttranslator.com/translate',
    ],

];
