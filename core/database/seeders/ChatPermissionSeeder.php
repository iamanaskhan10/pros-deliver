<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class ChatPermissionSeeder extends Seeder
{
    public function run()
    {
        // Chat
        Permission::updateOrCreate([
            'menu_name' => 'Chat',
            'name' => 'chat-settings-view',
            'guard_name' => 'admin'
        ]);
    }
}
