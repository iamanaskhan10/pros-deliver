<?php

namespace App\Http\Controllers\Frontend\Client;

use App\Http\Controllers\Controller;
use App\Jobs\AnalyzeApplicantsJob;
use App\Models\JobPost;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Modules\Subscription\Entities\UserSubscription;

class AIMatchingController extends Controller
{
    /**
     * Validate the request, check subscription eligibility, dispatch the
     * hybrid analysis job, and return a UUID for polling.
     */
    public function generate(Request $request): JsonResponse
    {
        $request->validate([
            'job_id' => 'required|integer|exists:job_posts,id',
        ]);

        $user = Auth::guard('web')->user();

        // Confirm the requesting user owns this job
        $job = JobPost::where('id', $request->job_id)
            ->where('user_id', $user->id)
            ->first();

        if (!$job) {
            return response()->json([
                'status'  => 'error',
                'message' => __('You do not have permission to analyze this job.'),
            ], 403);
        }

        // Subscription gating
        if (get_static_option('subscription_enable_disable') != 'disable') {
            $totalLimit = UserSubscription::where('user_id', $user->id)
                ->where('payment_status', 'complete')
                ->whereDate('expire_date', '>', Carbon::now())
                ->sum('limit');

            if ($totalLimit < (get_static_option('limit_settings') ?? 2)) {
                return response()->json([
                    'status'  => 'error',
                    'message' => __('You do not have enough connects to use AI Talent Matching.'),
                ], 403);
            }
        }

        // Check if we already have a cached result for this job (avoid repeated calls)
        $persistentKey = "ai_match_job_{$request->job_id}";
        if (Cache::has($persistentKey)) {
            return response()->json([
                'status' => 'done',
                'data'   => Cache::get($persistentKey),
            ]);
        }

        $uuid = (string) Str::uuid();

        // Store the mapping so the job can also write to the persistent key
        Cache::put("ai_match_uuid_{$uuid}", $request->job_id, now()->addMinutes(15));

        AnalyzeApplicantsJob::dispatch($request->job_id, $uuid);

        return response()->json([
            'status' => 'processing',
            'uuid'   => $uuid,
        ]);
    }

    /**
     * Poll endpoint: returns the cached analysis result once it is ready.
     */
    public function status(string $uuid): JsonResponse
    {
        if (!Str::isUuid($uuid)) {
            return response()->json(['status' => 'error', 'message' => 'Invalid request.'], 400);
        }

        $cacheKey = "ai_match_{$uuid}";
        $result   = Cache::get($cacheKey);

        if (!$result) {
            return response()->json(['status' => 'processing']);
        }

        Cache::forget($cacheKey);

        return response()->json($result);
    }
}
