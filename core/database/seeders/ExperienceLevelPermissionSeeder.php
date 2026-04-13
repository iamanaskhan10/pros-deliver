<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class ExperienceLevelPermissionSeeder extends Seeder
{
    public function run()
    {
        // Experience level
        $experience_permissions = [
            'experience-level-list',
            'experience-level-edit',
            'experience-level-delete',
            'experience-level-status-change',
            'experience-level-bulk-delete',
        ];

        foreach ($experience_permissions as $permission) {
            Permission::updateOrCreate([
                'menu_name' => 'Experience Level',
                'name' => $permission,
                'guard_name' => 'admin'
            ]);
        }
    }
}
