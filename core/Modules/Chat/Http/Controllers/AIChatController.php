<?php

namespace Modules\Chat\Http\Controllers;

use App\Jobs\GenerateSmartRepliesJob;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Modules\Chat\Entities\LiveChat;
use Modules\Chat\Entities\LiveChatMessage;
use Modules\Subscription\Entities\UserSubscription;

class AIChatController extends Controller
{
    /**
     * Fetch recent messages for the given client conversation, validate
     * subscription eligibility, dispatch the smart reply job, and return a UUID.
     */
    public function generate(Request $request): JsonResponse
    {
        $request->validate([
            'client_id' => 'required|integer|exists:users,id',
        ]);

        $user = Auth::guard('web')->user();

        // Only freelancers may use Smart Reply
        if ($user->user_type != 2) {
            return response()->json([
                'status'  => 'error',
                'message' => __('Smart Reply is only available for freelancers.'),
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
                    'message' => __('Upgrade your plan to use AI Smart Reply.'),
                ], 403);
            }
        }

        // Find the live chat thread for this freelancer-client pair
        $liveChat = LiveChat::where('freelancer_id', $user->id)
            ->where('client_id', $request->client_id)
            ->first();

        if (!$liveChat) {
            return response()->json([
                'status'  => 'error',
                'message' => __('No active conversation found with this client.'),
            ], 404);
        }

        // Fetch the last 10 messages for AI context
        $recentMessages = LiveChatMessage::where('live_chat_id', $liveChat->id)
            ->latest()
            ->limit(10)
            ->get()
            ->reverse()
            ->map(function ($msg) {
                // Safely extract the text content from the JSON message field
                $text = '';
                if (is_array($msg->message)) {
                    $text = $msg->message['message'] ?? $msg->message['text'] ?? '';
                } else {
                    $text = (string) $msg->message;
                }

                return [
                    'from'    => $msg->from_user, // 1 = client, 2 = freelancer
                    'message' => strip_tags($text),
                ];
            })
            ->values()
            ->toArray();

        if (empty($recentMessages)) {
            return response()->json([
                'status'  => 'error',
                'message' => __('No messages found to generate replies from.'),
            ], 422);
        }

        $uuid = (string) Str::uuid();

        GenerateSmartRepliesJob::dispatch($recentMessages, $user->id, $uuid);

        return response()->json([
            'status' => 'processing',
            'uuid'   => $uuid,
        ]);
    }

    /**
     * Polling endpoint: returns the cached smart reply result once available.
     */
    public function status(string $uuid): JsonResponse
    {
        if (!Str::isUuid($uuid)) {
            return response()->json(['status' => 'error', 'message' => 'Invalid request.'], 400);
        }

        $cacheKey = "ai_smart_reply_{$uuid}";
        $result   = Cache::get($cacheKey);

        if (!$result) {
            return response()->json(['status' => 'processing']);
        }

        Cache::forget($cacheKey);

        return response()->json($result);
    }
}
