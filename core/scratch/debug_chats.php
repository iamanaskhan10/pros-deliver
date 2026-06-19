<?php
use Modules\Chat\Entities\LiveChat;

$freelancerId = 131;
$chats = LiveChat::with('client')->where('freelancer_id', $freelancerId)->get();

echo "Total chats for freelancer {$freelancerId}: " . $chats->count() . "\n";
foreach ($chats as $chat) {
    echo "Chat ID: {$chat->id} | Client Name: " . ($chat->client?->name ?? 'NULL') . " | Client Email: " . ($chat->client?->email ?? 'NULL') . "\n";
}
