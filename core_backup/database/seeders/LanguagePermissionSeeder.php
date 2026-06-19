<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class LanguagePermissionSeeder extends Seeder
{
    public function run()
    {
        // Language extras
        Permission::updateOrCreate([
            'menu_name' => 'Language',
            'name' => 'language-delete',
            'guard_name' => 'admin'
        ]);

        // Page text settings extras
        Permission::updateOrCreate([
            'menu_name' => 'Page Text Settings',
            'name' => 'language-page-settings-view',
            'guard_name' => 'admin'
        ]);

        Permission::updateOrCreate([
            'menu_name' => 'Page Text Settings',
            'name' => 'location-page-settings-view',
            'guard_name' => 'admin'
        ]);

        // Country
        Permission::updateOrCreate([
            'menu_name' => 'Country',
            'name' => 'country-status.change',
            'guard_name' => 'admin'
        ]);
    }
}
