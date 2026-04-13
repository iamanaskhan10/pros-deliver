<?php

namespace App\Helper;

use Illuminate\Support\Facades\Cache;
use Modules\Chat\Entities\LiveChat;
use Modules\Chat\Entities\LiveChatMessage;

class InfluencerResponseTimeHelper
{
    /**
     * Get average response time for an influencer
     *
     * @param  int  $cacheDuration  Cache duration in minutes (default: 30)
     */
    public static function getAverageResponseTime(int $influencerId, int $cacheDuration = 30): array
    {
        $cacheKey = "influencer_avg_response_time_{$influencerId}";

        return Cache::remember($cacheKey, $cacheDuration * 60, function () use ($influencerId) {

            // Get chat IDs for this influencer
            $chatIds = LiveChat::where('freelancer_id', $influencerId)->pluck('id');

            if ($chatIds->isEmpty()) {
                return [
                    'average_response_time' => 0,
                    'formatted_time' => 'N/A',
                    'total_responses' => 0,
                ];
            }

            // Get influencer responses with their preceding client messages
            $responses = LiveChatMessage::select([
                'live_chat_messages.id',
                'live_chat_messages.live_chat_id',
                'live_chat_messages.created_at as response_time',
                'client_msg.created_at as client_message_time',
            ])
                ->join('live_chat_messages as client_msg', function ($join) {
                    $join->on('live_chat_messages.live_chat_id', '=', 'client_msg.live_chat_id')
                        ->where('client_msg.from_user', 1)
                        ->whereColumn('client_msg.created_at', '<', 'live_chat_messages.created_at');
                })
                ->whereIn('live_chat_messages.live_chat_id', $chatIds)
                ->where('live_chat_messages.from_user', 2)
                ->whereExists(function ($query) {
                    $query->select('id')
                        ->from('live_chat_messages as latest_client')
                        ->whereColumn('latest_client.live_chat_id', 'live_chat_messages.live_chat_id')
                        ->where('latest_client.from_user', 1)
                        ->whereColumn('latest_client.created_at', '<', 'live_chat_messages.created_at')
                        ->whereColumn('latest_client.created_at', '=', 'client_msg.created_at');
                })
                ->get();

            if ($responses->isEmpty()) {
                return [
                    'average_response_time' => 0,
                    'formatted_time' => 'N/A',
                    'total_responses' => 0,
                ];
            }

            $totalResponseTime = 0;
            $validResponses = 0;

            foreach ($responses as $response) {
                $responseTime = strtotime($response->response_time);
                $clientTime = strtotime($response->client_message_time);

                if ($responseTime > $clientTime) {
                    $diff = $responseTime - $clientTime;

                    // Only count responses within 7 days
                    if ($diff <= 7 * 24 * 60 * 60) {
                        $totalResponseTime += $diff;
                        $validResponses++;
                    }
                }
            }

            if ($validResponses === 0) {
                return [
                    'average_response_time' => 0,
                    'formatted_time' => 'N/A',
                    'total_responses' => 0,
                ];
            }

            // Minimum response time should be 1 hour (3600 seconds)
            $averageSeconds = max(3600, $totalResponseTime / $validResponses);

            return [
                'average_response_time' => round($averageSeconds),
                'formatted_time' => self::formatResponseTime($averageSeconds),
                'total_responses' => $validResponses,
            ];
        });
    }

    /**
     * Format response time in human-readable format
     */
    private static function formatResponseTime(float $seconds): string
    {
        if ($seconds < 60) {
            return round($seconds).' seconds';
        } elseif ($seconds < 3600) {
            $minutes = round($seconds / 60);

            return $minutes.' minute'.($minutes > 1 ? 's' : '');
        } elseif ($seconds < 86400) {
            $hours = round($seconds / 3600);

            return $hours.' hour'.($hours > 1 ? 's' : '');
        } else {
            $days = round($seconds / 86400);

            return $days.' day'.($days > 1 ? 's' : '');
        }
    }

    /**
     * Clear cache for specific influencer
     * Call this when new messages are created
     */
    public static function clearCache(int $influencerId): void
    {
        Cache::forget("influencer_avg_response_time_{$influencerId}");
    }
}
