<?php

namespace App\Services\AI;

use App\Models\Skill;
use App\Services\AI\OpenAIService;
use Illuminate\Support\Facades\Cache;
use Modules\Service\Entities\Category;

class AIJobPostGenerator
{
    private OpenAIService $openAI;

    public function __construct(OpenAIService $openAI)
    {
        $this->openAI = $openAI;
    }

    /**
     * Generate a structured job post from a raw user description.
     *
     * @param  string  $userDescription  Raw text from the user (max 500 chars).
     * @return array{
     *   title: string,
     *   description: string,
     *   budget: int,
     *   type: string,
     *   category_id: int|null,
     *   skill_ids: int[],
     *   matched_skills: string[],
     *   unmatched_skills: string[]
     * }
     *
     * @throws \RuntimeException On AI or parsing failure.
     */
    public function generate(string $userDescription): array
    {
        // Load DB data for mapping
        $categories    = $this->loadCategories();
        $skills        = $this->loadSkills();
        $lengths       = $this->loadLengths();
        $levels        = $this->loadLevels();

        $categoryList  = $categories->pluck('category')->implode(', ');
        $skillList     = $skills->pluck('skill')->implode(', ');
        $durationList  = $lengths->pluck('length')->implode(', ');
        $levelList     = $levels->pluck('level')->implode(', ');

        $systemPrompt = <<<PROMPT
You are a professional job post writer for a freelancer marketplace.
Your task: given a raw user idea, output a structured JSON job post.

STRICT RULES:
- Output ONLY valid JSON. NEVER use markdown code blocks or backticks.
- JSON keys: title, description, budget, type, category, subcategory, duration, level, meta_title, meta_description, skills
- category: Pick the single closest match from: [{$categoryList}].
- subcategory: Suggest a logical subcategory name.
- duration: Pick exactly one from: [{$durationList}].
- level: Pick exactly one from: [{$levelList}].
- meta_title: SEO title (max 60 chars).
- meta_description: SEO description (max 160 chars).
- skills: Suggest 3-5 professional skills that are the PERFECT match for this specific job description. Ignore the existing list if it doesn't have good matches.
PROMPT;

        $userPrompt = 'Create a job post for: ' . $userDescription;

        // Call OpenAI
        $rawOutput = $this->openAI->complete($systemPrompt, $userPrompt);
        
        \Illuminate\Support\Facades\Log::info('AI Job Raw Output', ['output' => $rawOutput]);

        $rawOutput = preg_replace('/^```(?:json)?\s*/i', '', trim($rawOutput));
        $rawOutput = preg_replace('/\s*```$/', '', $rawOutput);

        $parsed = json_decode(trim($rawOutput), true);

        if (json_last_error() !== JSON_ERROR_NONE || !is_array($parsed)) {
            throw new \RuntimeException('AI returned invalid JSON. Please try again.');
        }

        // Map category
        $categoryId = $this->resolveCategoryId($parsed['category'] ?? null, $categories);
        
        // Map subcategory (fuzzy match from DB)
        $subCategoryId = $this->resolveSubCategoryId($categoryId, $parsed['subcategory'] ?? null);

        // Map skill IDs (Create if not exists)
        $skillData = $this->resolveAndCreateSkillData(
            $parsed['skills'] ?? [],
            $categoryId,
            $subCategoryId
        );

        return [
            'title'            => $this->sanitizeString($parsed['title'] ?? '', 80),
            'description'      => $this->sanitizeString($parsed['description'] ?? '', 2000),
            'budget'           => max(1, (int) ($parsed['budget'] ?? 0)),
            'type'             => in_array($parsed['type'] ?? '', ['Onsite', 'Online']) ? $parsed['type'] : 'Online',
            'category_id'      => $categoryId,
            'sub_category_id'  => $subCategoryId,
            'duration'         => $parsed['duration'] ?? '1 Days',
            'level'            => $parsed['level'] ?? null,
            'meta_title'       => $this->sanitizeString($parsed['meta_title'] ?? '', 60),
            'meta_description' => $this->sanitizeString($parsed['meta_description'] ?? '', 160),
            'skills'           => $skillData,
            'matched_skills'   => [], // No longer needed for frontend notice
            'unmatched_skills' => [],
        ];
    }

    /**
     * Resolve skill IDs. If a skill doesn't exist, create it on the fly.
     */
    private function resolveAndCreateSkillData(array $aiSkills, $categoryId, $subCategoryId): array
    {
        $skillData = [];
        foreach ($aiSkills as $aiSkill) {
            $name = trim((string) $aiSkill);
            if (empty($name)) continue;

            $skill = Skill::where('skill', 'LIKE', $name)->first();

            if (!$skill) {
                // Create the missing skill so it can be selected
                $skill = Skill::create([
                    'skill'           => $name,
                    'category_id'     => $categoryId,
                    'sub_category_id' => $subCategoryId,
                    'status'          => 1
                ]);
                
                // Clear cache so the new skill is available for next requests
                Cache::forget('ai_skills_list');
            }

            $skillData[] = [
                'id'   => $skill->id,
                'name' => $skill->skill
            ];
        }

        return $skillData;
    }

    private function loadLevels()
    {
        return Cache::remember('ai_levels_list', 3600, function () {
            return \App\Models\ExperienceLevel::where('status', 1)->select(['id', 'level'])->get();
        });
    }

    private function loadLengths()
    {
        return Cache::remember('ai_lengths_list', 3600, function () {
            return \App\Models\Length::where('status', 1)->select(['id', 'length'])->get();
        });
    }

    private function resolveSubCategoryId($categoryId, ?string $aiSubCategory): ?int
    {
        if (empty($categoryId) || empty($aiSubCategory)) return null;

        $needle = strtolower(trim($aiSubCategory));
        $subs = \Modules\Service\Entities\SubCategory::where('category_id', $categoryId)
            ->where('status', 1)
            ->get();

        $match = $subs->first(function ($s) use ($needle) {
            return strtolower(trim($s->sub_category)) === $needle;
        });

        if (!$match) {
            $match = $subs->first(function ($s) use ($needle) {
                $haystack = strtolower(trim($s->sub_category));
                return str_contains($haystack, $needle) || str_contains($needle, $haystack);
            });
        }

        return $match ? $match->id : ($subs->first()->id ?? null);
    }

    /**
     * Load active categories from DB with caching.
     */
    private function loadCategories()
    {
        return Cache::remember('ai_categories_list', 300, function () {
            return Category::where('status', 1)->select(['id', 'category'])->get();
        });
    }

    /**
     * Load active skills from DB with caching.
     */
    private function loadSkills()
    {
        return Cache::remember('ai_skills_list', 300, function () {
            return Skill::where('status', 1)->select(['id', 'skill'])->get();
        });
    }

    /**
     * Match AI category name to an existing DB category ID.
     * Uses case-insensitive fuzzy matching.
     */
    private function resolveCategoryId(?string $aiCategory, $categories): ?int
    {
        if (empty($aiCategory)) {
            return null;
        }

        $needle = strtolower(trim($aiCategory));

        $match = $categories->first(function ($cat) use ($needle) {
            return strtolower(trim($cat->category)) === $needle;
        });

        if (!$match) {
            // Fuzzy: check if DB category name is contained in AI output or vice versa
            $match = $categories->first(function ($cat) use ($needle) {
                $haystack = strtolower(trim($cat->category));
                return str_contains($haystack, $needle) || str_contains($needle, $haystack);
            });
        }

        return $match ? $match->id : null;
    }

    /**
     * Match AI skill names to existing DB skill IDs.
     * Returns [matched_ids[], matched_names[], unmatched_names[]]
     */
    private function resolveSkillIds(array $aiSkills, $skills): array
    {
        $matchedIds    = [];
        $matchedNames  = [];
        $unmatchedNames = [];

        foreach ($aiSkills as $aiSkill) {
            $needle = strtolower(trim((string) $aiSkill));

            $match = $skills->first(function ($skill) use ($needle) {
                return strtolower(trim($skill->skill)) === $needle;
            });

            if (!$match) {
                // Fuzzy match
                $match = $skills->first(function ($skill) use ($needle) {
                    $haystack = strtolower(trim($skill->skill));
                    return str_contains($haystack, $needle) || str_contains($needle, $haystack);
                });
            }

            if ($match) {
                $matchedIds[]   = $match->id;
                $matchedNames[] = $match->skill;
            } else {
                $unmatchedNames[] = $aiSkill;
            }
        }

        return [$matchedIds, $matchedNames, $unmatchedNames];
    }

    /**
     * Sanitize and trim a string to a max length.
     */
    private function sanitizeString(string $value, int $maxLength): string
    {
        return substr(strip_tags(trim($value)), 0, $maxLength);
    }
}
