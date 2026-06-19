<?php

namespace Modules\Credit\App\Services;

use Modules\Credit\App\Models\UnlockedInfluencer;
use Modules\Credit\App\Models\UserCredit;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CreditLogicService
{
    /**
     * Check if an influencer's profile is unlocked for a specific client.
     */
    public static function isUnlocked(int $influencer_id, ?int $client_id = null): bool
    {
        $visibility = get_static_option('influencer_contact_visibility', 'free');

        if ($visibility === 'free') {
            return true;
        }

        $client_id = $client_id ?? Auth::guard('web')->id();

        if (!$client_id) {
            return false;
        }

        // If the logged-in user is the influencer themselves, they can see their own links
        if ($client_id === $influencer_id) {
            return true;
        }

        // Check if the influencer has unlocked it already
        return UnlockedInfluencer::where('client_id', $client_id)
            ->where('influencer_id', $influencer_id)
            ->exists();
    }

    /**
     * Unlock an influencer's profile for a client.
     */
    public static function unlockInfluencer(int $influencer_id, int $client_id): array
    {
        if (self::isUnlocked($influencer_id, $client_id)) {
            return ['status' => true, 'message' => __('Profile already unlocked.')];
        }

        $credits_required = (int) get_static_option('influencer_credits_per_unlock', 1);
        $user_credit = UserCredit::where('user_id', $client_id)->first();

        if (!$user_credit || $user_credit->credit_balance < $credits_required) {
            return ['status' => false, 'message' => __('Insufficient credits.')];
        }

        // Deduct credits
        $user_credit->deductCredits($credits_required);

        // Create unlock record
        UnlockedInfluencer::create([
            'client_id' => $client_id,
            'influencer_id' => $influencer_id,
            'credits_used' => $credits_required,
        ]);

        return ['status' => true, 'message' => __('Profile unlocked successfully.')];
    }
}
