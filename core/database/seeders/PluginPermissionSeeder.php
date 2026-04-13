<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PluginPermissionSeeder extends Seeder
{
    public function run()
    {
        $plugin_permissions = [
            'plugin-list',
            'plugin-add',
            'plugin-delete',
            'plugin-status-change',
        ];

        foreach ($plugin_permissions as $permission) {
            Permission::updateOrCreate([
                'menu_name' => 'Plugin',
                'name' => $permission,
                'guard_name' => 'admin'
            ]);
        }
    }
}
