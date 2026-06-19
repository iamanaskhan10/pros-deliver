<?php
use App\Models\User;
use Modules\Subscription\Entities\UserSubscription;
use Modules\Subscription\Entities\Subscription;

$targetEmails = ['user@test.com', 'ayeshanoor@example.com'];
$subId = Subscription::first()?->id ?? 1;

foreach ($targetEmails as $email) {
    $user = User::where('email', $email)->first();
    if ($user) {
        UserSubscription::updateOrCreate(
            ['user_id' => $user->id],
            [
                'subscription_id' => $subId,
                'limit' => 1000,
                'expire_date' => now()->addYear(),
                'payment_status' => 'complete'
            ]
        );
        echo "Subscription updated for {$email} (ID: {$user->id}) with Sub ID {$subId}\n";
    }
}
