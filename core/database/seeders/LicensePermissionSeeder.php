<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class LicensePermissionSeeder extends Seeder
{
    public function run()
    {
        $license_permissions = [
            'generate-license-key',
            'update-license',
        ];

        foreach ($license_permissions as $permission) {
            Permission::updateOrCreate([
                'menu_name' => 'License Manage',
                'name' => $permission,
                'guard_name' => 'admin'
            ]);
        }
    }
}
