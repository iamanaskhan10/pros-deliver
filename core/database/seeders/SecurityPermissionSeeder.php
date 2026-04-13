<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class SecurityPermissionSeeder extends Seeder
{
    public function run()
    {
        $security_permissions = [
            // Word Settings
            'word-list',
            'word-add',
            'word-edit',
            'word-delete',
            'word-status-change',
            'word-bulk-delete',

            // Log History
            'log-list',
            'log-delete',
            'log-bulk-delete',

            // Freeze Actions (User Security)
            'user-freeze-withdrawal',
            'user-freeze-project',
            'user-freeze-job',
            'user-freeze-new-order',
            'user-freeze-chat',
        ];

        foreach ($security_permissions as $permission) {
            Permission::updateOrCreate([
                'menu_name' => 'Security',
                'name' => $permission,
                'guard_name' => 'admin'
            ]);
        }
    }
}
