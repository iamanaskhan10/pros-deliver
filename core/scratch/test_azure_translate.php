<?php
use App\Services\Translation\TranslatorService;

$translator = app(TranslatorService::class);

echo "=== Test 1: English -> French ===\n";
$r1 = $translator->translate('Hello, how are you?', 'fr');
echo "Original:   {$r1['original']}\n";
echo "Translated: {$r1['translated']}\n";
echo "Detected:   {$r1['detected_lang']}\n";
echo "Cached:     " . ($r1['cached'] ? 'yes' : 'no') . "\n\n";

echo "=== Test 2: English -> Arabic ===\n";
$r2 = $translator->translate('I need a freelancer for my project', 'ar');
echo "Original:   {$r2['original']}\n";
echo "Translated: {$r2['translated']}\n";
echo "Detected:   {$r2['detected_lang']}\n";
echo "Cached:     " . ($r2['cached'] ? 'yes' : 'no') . "\n\n";

echo "=== Test 3: Spanish -> English ===\n";
$r3 = $translator->translate('Necesito un desarrollador web', 'en');
echo "Original:   {$r3['original']}\n";
echo "Translated: {$r3['translated']}\n";
echo "Detected:   {$r3['detected_lang']}\n";
echo "Cached:     " . ($r3['cached'] ? 'yes' : 'no') . "\n";
