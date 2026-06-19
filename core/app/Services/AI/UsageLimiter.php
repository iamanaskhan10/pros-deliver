<?php

namespace App\Services\AI;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * UsageLimiter
 *
 * Centralized daily usage tracking and enforcement for all AI features.
 * Stores usage in the ai_usage_logs table and caches counts for performance.
 *
 * Features:
 *  - Per-user, per-feature daily limits
 *  - Configurable limits for free vs premium users
 *  - Cache-backed counters (1-minute TTL) to avoid N+1 queries
 *  - Graceful logging of all AI activity
 */
class UsageLimiter
{
    // Feature identifiers — use these constants everywhere
    public const FEATURE_JOB_AI       = 'job_ai';
    public const FEATURE_PROPOSAL_AI  = 'proposal_ai';
    public const FEATURE_MATCHING     = 'matching';
    public const FEATURE_OUTREACH     = 'outreach';
    public const FEATURE_TRANSLATION  = 'translation';
    public const FEATURE_SMART_REPLY  = 'smart_reply';

    /**
     * Check whether a user has exceeded their daily limit for a feature.
     *
     * @param  int     $userId
     * @param  string  $feature   One of the FEATURE_* constants
     * @param  bool    $isPremium Whether the user holds an active premium subscription
     * @return bool               TRUE if the user is still within their limit
     */
    public function isAllowed(int $userId, string $feature, bool $isPremium = false): bool
    {
        $limit = $this->getDailyLimit($feature, $isPremium);

        // Unlimited access
        if ($limit === -1) {
            return true;
        }

        $used = $this->getDailyUsage($userId, $feature);

        return $used < $limit;
    }

    /**
     * Record one AI call in the usage logs.
     *
     * @param  int     $userId
     * @param  string  $feature
     * @param  array   $meta     Optional extra data (job_id, proposal_id, etc.)
     */
    public function record(int $userId, string $feature, array $meta = []): void
    {
        try {
            DB::table('ai_usage_logs')->insert([
                'user_id'    => $userId,
                'feature'    => $feature,
                'meta'       => !empty($meta) ? json_encode($meta) : null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Bust the count cache so it reflects immediately on next check
            Cache::forget($this->cacheKey($userId, $feature));

        } catch (\Exception $e) {
            // Non-fatal: log and continue — don't block the user's AI call
            Log::warning('UsageLimiter: failed to record usage', [
                'user_id' => $userId,
                'feature' => $feature,
                'error'   => $e->getMessage(),
            ]);
        }
    }

    /**
     * Return a user's total usage count for today for a given feature.
     */
    public function getDailyUsage(int $userId, string $feature): int
    {
        $key = $this->cacheKey($userId, $feature);

        return Cache::remember($key, now()->addMinutes(2), function () use ($userId, $feature) {
            return DB::table('ai_usage_logs')
                ->where('user_id', $userId)
                ->where('feature', $feature)
                ->whereDate('created_at', today())
                ->count();
        });
    }

    /**
     * Return the daily request limit for a feature + user tier combination.
     * -1 means unlimited.
     */
    public function getDailyLimit(string $feature, bool $isPremium): int
    {
        $limits = [
            // feature => [free, premium]
            self::FEATURE_JOB_AI      => [10, -1],
            self::FEATURE_PROPOSAL_AI => [10, -1],
            self::FEATURE_MATCHING    => [3,  -1],
            self::FEATURE_OUTREACH    => [5,  -1],
            self::FEATURE_TRANSLATION => [0,  -1],   // Translation is premium-only
            self::FEATURE_SMART_REPLY => [5,  -1],
        ];

        if (!isset($limits[$feature])) {
            return 10; // Safe default
        }

        return $isPremium ? $limits[$feature][1] : $limits[$feature][0];
    }

    /**
     * Remaining uses for a feature today.
     */
    public function remaining(int $userId, string $feature, bool $isPremium = false): int|string
    {
        $limit = $this->getDailyLimit($feature, $isPremium);
        if ($limit === -1) return 'unlimited';

        return max(0, $limit - $this->getDailyUsage($userId, $feature));
    }

    /**
     * Build a deterministic cache key for a user+feature daily count.
     */
    private function cacheKey(int $userId, string $feature): string
    {
        return "ai_usage_{$userId}_{$feature}_" . today()->toDateString();
    }
}
