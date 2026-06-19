<?php

namespace App\Http\Controllers\Frontend\Freelancer;

use App\Http\Controllers\Controller;
use App\Jobs\EnhanceProfileJob;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class AIProfileController extends Controller
{
    /**
     * Validate eligibility, dispatch the profile enhancement job,
     * and return a UUID for the frontend to poll.
     */
    public function enhance(): JsonResponse
    {
        $user = Auth::guard('web')->user();

        // Only freelancers may use this feature
        if ($user->user_type != 2) {
            return response()->json([
                'status'  => 'error',
                'message' => __('Only freelancers can use the profile enhancer.'),
            ], 403);
        }

        if ($user->is_suspend == 1) {
            return response()->json([
                'status'  => 'error',
                'message' => __('Your account is suspended. Please contact support.'),
            ], 403);
        }

        $uuid = (string) Str::uuid();

        EnhanceProfileJob::dispatch($user->id, $uuid);

        return response()->json([
            'status' => 'processing',
            'uuid'   => $uuid,
        ]);
    }

    /**
     * Poll endpoint: returns the cached enhancement result once available.
     */
    public function status(string $uuid): JsonResponse
    {
        if (!Str::isUuid($uuid)) {
            return response()->json(['status' => 'error', 'message' => 'Invalid request.'], 400);
        }

        $cacheKey = "ai_enhance_{$uuid}";
        $result   = Cache::get($cacheKey);

        if (!$result) {
            return response()->json(['status' => 'processing']);
        }

        Cache::forget($cacheKey);

        return response()->json($result);
    }
}
