<?php

namespace App\Http\Controllers\Frontend\Client;

use App\Http\Controllers\Controller;
use App\Models\JobPost;
use App\Services\AI\AutoOutreachService;
use App\Services\AI\UsageLimiter;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Subscription\Entities\UserSubscription;

/**
 * AutoOutreachController
 *
 * Handles AI-generated outreach message generation for clients.
 * Called after matching results are displayed — client clicks
 * "Contact with AI" on a specific matched freelancer.
 *
 * Feature gating:
 *  - Must be authenticated as a client (user_type == 1)
 *  - Must own the job post
 *  - Subject to UsageLimiter daily quotas
 */
class AutoOutreachController extends Controller
{
    public function __construct(
        private AutoOutreachService $outreach,
        private UsageLimiter        $limiter
    ) {}

    /**
     * Generate an AI outreach message for a specific freelancer.
     *
     * POST /client/job/outreach
     * Body: { job_id: int, freelancer_id: int }
     */
    public function generate(Request $request): JsonResponse
    {
        $request->validate([
            'job_id'        => 'required|integer|exists:job_posts,id',
            'freelancer_id' => 'required|integer|exists:users,id',
        ]);

        $user = Auth::guard('web')->user();

        // Verify the client owns this job
        $job = JobPost::where('id', $request->job_id)
            ->where('user_id', $user->id)
            ->first();

        if (!$job) {
            return response()->json([
                'status'  => 'error',
                'message' => __('You do not have permission to send outreach for this job.'),
            ], 403);
        }

        // Determine premium status via active subscription
        $isPremium = false;
        if (get_static_option('subscription_enable_disable') !== 'disable') {
            $isPremium = UserSubscription::where('user_id', $user->id)
                ->where('payment_status', 'complete')
                ->whereDate('expire_date', '>', Carbon::now())
                ->where('limit', '>', 0)
                ->exists();
        }

        // Usage limit check
        if (!$this->limiter->isAllowed($user->id, UsageLimiter::FEATURE_OUTREACH, $isPremium)) {
            $limit = $this->limiter->getDailyLimit(UsageLimiter::FEATURE_OUTREACH, $isPremium);
            return response()->json([
                'status'  => 'error',
                'message' => __("You have reached your daily limit of {$limit} AI outreach messages."),
            ], 429);
        }

        try {
            $message = $this->outreach->generate(
                (int) $request->job_id,
                (int) $request->freelancer_id
            );

            // Record usage only on success
            $this->limiter->record($user->id, UsageLimiter::FEATURE_OUTREACH, [
                'job_id'        => $request->job_id,
                'freelancer_id' => $request->freelancer_id,
            ]);

            return response()->json([
                'status'  => 'success',
                'message' => $message,
                'remaining' => $this->limiter->remaining($user->id, UsageLimiter::FEATURE_OUTREACH, $isPremium),
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => __('Could not generate outreach message. Please try again.'),
            ], 500);
        }
    }
}
