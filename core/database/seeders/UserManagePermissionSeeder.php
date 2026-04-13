<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class UserManagePermissionSeeder extends Seeder
{
    public function run()
    {
        // User manage additions
        Permission::updateOrCreate([
            'menu_name' => 'User Manage',
            'name' => 'user-add',
            'guard_name' => 'admin'
        ]);

        Permission::updateOrCreate([
            'menu_name' => 'User Manage',
            'name' => 'user-email-send-all',
            'guard_name' => 'admin'
        ]);

        // User report
        Permission::updateOrCreate([
            'menu_name' => 'User Report',
            'name' => 'user-report-list',
            'guard_name' => 'admin'
        ]);

        Permission::updateOrCreate([
            'menu_name' => 'User Report',
            'name' => 'user-report-update',
            'guard_name' => 'admin'
        ]);
    }
}
