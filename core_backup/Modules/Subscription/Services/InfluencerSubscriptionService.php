<?php

namespace Modules\Subscription\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Modules\Subscription\Entities\UserSubscription;

class InfluencerSubscriptionService
{
    public static function getActiveSubscription(int $influencerId, bool $forUpdate = false): ?UserSubscription
    {
        $query = UserSubscription::where('user_id', $influencerId)
            ->where('status', 1)
            ->where('payment_status', 'complete')
            ->whereDate('expire_date', '>=', Carbon::today())
            ->latest('id');

        if ($forUpdate) {
            $query->lockForUpdate();
        }

        return $query->first();
    }

    /**
     * Check if influencer still has connects left.
     */
    public static function canReceiveNewContact(int $influencerId): bool
    {
        return DB::transaction(function () use ($influencerId) {
            $us = self::getActiveSubscription($influencerId, true);
            if (!$us) return false;

            return (int)$us->limit > 0;
        });
    }

    /**
     * Deduct exactly 1 connect (throws if none left).
     * Call ONLY on first chat between a new client + influencer.
     */
    public static function deductConnect(int $influencerId): void
    {
        DB::transaction(function () use ($influencerId) {
            $us = self::getActiveSubscription($influencerId, true);

            if (!$us) {
                throw new \RuntimeException(__('No active subscription found. Please subscribe to receive new messages.'));
            }

            if ((int)$us->limit <= 0) {
                throw new \RuntimeException(__('You have no connect points left. Please upgrade or renew your subscription.'));
            }

            $us->limit = (int)$us->limit - 1;
            $us->save();
        });
    }
}
