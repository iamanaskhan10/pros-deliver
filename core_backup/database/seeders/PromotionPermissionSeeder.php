<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PromotionPermissionSeeder extends Seeder
{
    public function run()
    {
        // ==================== PROMOTION PERMISSIONS ====================
        $promote_permissions = [
            // Project Promotion Settings
            'project-promote-settings-view',
            'project-promote-settings-edit',
            'project-promote-settings-delete',
            'project-promote-settings-status-change',

            // Promoted Projects List
            'promoted-project-list-view',
            'promoted-project-payment-status-change',
            'promoted-project-delete',

            // Promoted Profiles List
            'promoted-profile-list-view',
            'promoted-profile-payment-status-change',
            'promoted-profile-delete',

            // Promotion Transaction Settings
            'promotion-transaction-fee-settings-view',
            'promotion-transaction-fee-settings-edit',
            'promotion-projects-perpage-settings-edit',

            // Promotion Email Settings
            'promotion-email-settings-view',
            'promotion-email-settings-edit',
        ];

        foreach ($promote_permissions as $permission) {
            Permission::updateOrCreate([
                'menu_name' => 'Promotion',
                'name' => $permission,
                'guard_name' => 'admin'
            ]);
        }

        // Optional: Parent permission to show/hide the entire promotion menu
        Permission::updateOrCreate([
            'menu_name' => 'Promotion',
            'name' => 'promotion-menu-access',
            'guard_name' => 'admin'
        ]);
    }
}
