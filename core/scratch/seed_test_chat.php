<?php
use Modules\Chat\Entities\LiveChat;
use Modules\Chat\Entities\LiveChatMessage;
use App\Models\User;

$targetEmails = ['user@test.com', 'ayeshanoor@example.com'];

foreach ($targetEmails as $email) {
    $freelancer = User::where('email', $email)->first();
    if (!$freelancer) continue;
    
    $freelancerId = $freelancer->id;
    
    // Ensure freelancer type
    $freelancer->update(['user_type' => 2]);

    // Find some clients
    $clients = User::where('user_type', 1)->limit(3)->get();

    foreach ($clients as $client) {
        $chat = LiveChat::updateOrCreate([
            'freelancer_id' => $freelancerId,
            'client_id' => $client->id,
        ]);

        // Clear existing messages
        LiveChatMessage::where('live_chat_id', $chat->id)->delete();

        $messages = [
            "Hi! I'm interested in working with you.",
            "Could you tell me more about your experience with AI tools?",
            "What is your typical turnaround time for a social media campaign?"
        ];

        foreach ($messages as $msg) {
            LiveChatMessage::create([
                'live_chat_id' => $chat->id,
                'from_user' => 1, // client
                'message' => [
                    'message' => $msg, // MUST BE 'message' KEY
                    'project' => []    // MUST BE PRESENT
                ],
            ]);
        }
    }
    echo "Seeded 3 chats for freelancer {$email} (ID: {$freelancerId})\n";
}
