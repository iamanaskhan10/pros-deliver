<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class IntegrationPermissionSeeder extends Seeder
{
    public function run()
    {
        // Integrations
        $integration_permissions = [
            'integration-view',
            'integration-edit',
        ];

        foreach ($integration_permissions as $permission) {
            Permission::updateOrCreate([
                'menu_name' => 'Integrations',
                'name' => $permission,
                'guard_name' => 'admin'
            ]);
        }
    }
}
