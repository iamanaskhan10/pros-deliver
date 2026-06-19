<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class LengthPermissionSeeder extends Seeder
{
    public function run()
    {
        // Length
        $length_permissions = [
            'length-list',
            'length-edit',
            'length-delete',
            'length-status-change',
            'length-bulk-delete',
        ];

        foreach ($length_permissions as $permission) {
            Permission::updateOrCreate([
                'menu_name' => 'Length',
                'name' => $permission,
                'guard_name' => 'admin'
            ]);
        }
    }
}
