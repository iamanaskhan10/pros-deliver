<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$user = User::updateOrCreate(
    ['email' => 'user@test.com'],
    [
        'first_name' => 'John',
        'last_name' => 'Doe',
        'username' => 'user',
        'password' => Hash::make('password'),
        'user_type' => 1,
        'is_email_verified' => 1,
        'user_active_inactive_status' => 1,
        'user_verified_status' => 1
    ]
);

echo "User created with ID: " . $user->id . "\n";
