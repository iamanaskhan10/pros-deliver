<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // === Add missing role management permissions ===
        $role_permissions = [
            'role-list',
            'role-add',
            'role-edit',
            'role-delete',
            'permission-assign',
        ];

        foreach ($role_permissions as $permission) {
            Permission::updateOrCreate([
                'menu_name' => 'Role',
                'name' => $permission,
                'guard_name' => 'admin'
            ]);
        }
    }
}
