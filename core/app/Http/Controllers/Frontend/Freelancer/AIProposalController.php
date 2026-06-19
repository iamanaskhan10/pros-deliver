<?php

namespace App\Http\Controllers\Frontend\Freelancer;

use App\Http\Controllers\Controller;
use App\Jobs\GenerateProposalJob;
use App\Models\JobPost;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Modules\Subscription\Entities\UserSubscription;

class AIProposalController extends Controller
{
    /**
     * Validate eligibility, dispatch the async AI generation job,
     * and return a UUID the frontend uses to poll for the result.
     */
    public function generate(Request $request): JsonResponse
    {
        $request->validate([
            'job_id' => 'required|integer|exists:job_posts,id',
        ]);

        $user = Auth::guard('web')->user();

        // Only freelancers / influencers may generate proposals
        if ($user->user_type != 2) {
            return response()->json([
                'status'  => 'error',
                'message' => __('Only freelancers can generate proposals.'),
            ], 403);
        }

        if ($user->is_suspend == 1) {
            return response()->json([
                'status'  => 'error',
                'message' => __('Your account is suspended. Please contact the administrator.'),
            ], 403);
        }

        // Subscription eligibility check (mirrors JobDetailsController logic)
        if (get_static_option('subscription_enable_disable') != 'disable') {
            $totalLimit = UserSubscription::where('user_id', $user->id)
                ->where('payment_status', 'complete')
                ->whereDate('expire_date', '>', Carbon::now())
                ->sum('limit');

            if ($totalLimit < (get_static_option('limit_settings') ?? 2)) {
                return response()->json([
                    'status'  => 'error',
                    'message' => __('You do not have enough connects to use the AI proposal generator.'),
                ], 403);
            }
        }

        // Ensure the freelancer hasn't already applied to this job
        $alreadyApplied = \App\Models\JobProposal::where('freelancer_id', $user->id)
            ->where('job_id', $request->job_id)
            ->exists();

        if ($alreadyApplied) {
            return response()->json([
                'status'  => 'error',
                'message' => __('You have already submitted a proposal for this job.'),
            ], 403);
        }

        // Generate a unique tracking UUID for this request
        $uuid = (string) Str::uuid();

        // Dispatch to queue — non-blocking
        GenerateProposalJob::dispatch($request->job_id, $user->id, $uuid);

        return response()->json([
            'status' => 'processing',
            'uuid'   => $uuid,
        ]);
    }

    /**
     * Poll endpoint: returns the queued AI result once it is ready.
     */
    public function status(string $uuid): JsonResponse
    {
        // Validate uuid format to prevent cache poisoning
        if (!Str::isUuid($uuid)) {
            return response()->json(['status' => 'error', 'message' => 'Invalid request.'], 400);
        }

        $cacheKey = "ai_proposal_{$uuid}";
        $result   = Cache::get($cacheKey);

        if (!$result) {
            // Job is still processing
            return response()->json(['status' => 'processing']);
        }

        // Consume the cache entry — one-time delivery
        Cache::forget($cacheKey);

        return response()->json($result);
    }
}
