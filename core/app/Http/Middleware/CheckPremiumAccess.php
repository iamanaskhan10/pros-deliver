<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Modules\Subscription\Entities\UserSubscription;
use Symfony\Component\HttpFoundation\Response;

/**
 * CheckPremiumAccess
 *
 * Restricts access to advanced AI features (Matching, Smart Reply, Translation)
 * to users with an active, paid subscription.
 *
 * Free users receive a 403 JSON response with a clear upgrade message.
 * This middleware is stateless and does not modify the subscription itself.
 *
 * Registration alias: 'premium.access'
 */
class CheckPremiumAccess
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth('web')->user();

        // Must be authenticated
        if (!$user) {
            return response()->json([
                'status'  => 'error',
                'message' => __('You must be logged in to use this feature.'),
            ], 401);
        }

        // If subscriptions are globally disabled, allow all users through
        if (get_static_option('subscription_enable_disable') === 'disable') {
            return $next($request);
        }

        // Check for at least one valid active subscription
        $hasActive = UserSubscription::where('user_id', $user->id)
            ->where('payment_status', 'complete')
            ->whereDate('expire_date', '>', Carbon::now())
            ->where('limit', '>', 0)
            ->exists();

        if (!$hasActive) {
            if ($request->expectsJson()) {
                return response()->json([
                    'status'  => 'error',
                    'message' => __('Upgrade your plan to access this AI feature.'),
                ], 403);
            }

            return redirect()->route('frontend.subscription.index')
                ->with('warning', __('Please upgrade your plan to use this AI feature.'));
        }

        return $next($request);
    }
}
