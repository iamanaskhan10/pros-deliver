<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class AdministratorPermissionSeeder extends Seeder
{
    public function run()
    {
        // === Add missing administrator management permissions ===
        $administrator_permissions = [
            'administrator-list',
            'administrator-add',
            'administrator-edit',
            'administrator-delete',
        ];

        foreach ($administrator_permissions as $permission) {
            Permission::updateOrCreate([
                'menu_name' => 'Administrator',
                'name' => $permission,
                'guard_name' => 'admin'
            ]);
        }
    }
}
