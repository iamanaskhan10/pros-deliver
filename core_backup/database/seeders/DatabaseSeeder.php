<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            BlogPermissionSeeder::class,
            LicensePermissionSeeder::class,
            PromotionPermissionSeeder::class,
            SecurityPermissionSeeder::class,
            PluginPermissionSeeder::class,
            AdministratorPermissionSeeder::class,
            RolePermissionSeeder::class,
            ExperienceLevelPermissionSeeder::class,
            LengthPermissionSeeder::class,
            FeedbackPermissionSeeder::class,
            NewsletterPermissionSeeder::class,
            IntegrationPermissionSeeder::class,
            CreditPermissionSeeder::class,
            ChatPermissionSeeder::class,
            PortfolioPermissionSeeder::class,
            SupportTicketPermissionSeeder::class,
            UserManagePermissionSeeder::class,
            LanguagePermissionSeeder::class,
        ]);

        // Optional: Assign these permissions to the "Super Admin" role
        $this->assignPermissionsToSuperAdmin();
    }

    /**
     * Assign permissions to Super Admin role
     * This ensures the security fix is applied immediately
     */
    private function assignPermissionsToSuperAdmin()
    {
        try {
            $superAdminRole = \Spatie\Permission\Models\Role::where('name', 'Super Admin')
                ->where('guard_name', 'admin')
                ->first();

            if ($superAdminRole) {
                // Get all the new permissions we just created
                $newPermissions = [
                    'administrator-list',
                    'administrator-add',
                    'administrator-edit',
                    'administrator-delete',
                    'role-list',
                    'role-add',
                    'role-edit',
                    'role-delete',
                    'permission-assign',
                    'length-list',
                    'length-edit',
                    'length-delete',
                    'length-status-change',
                    'length-bulk-delete',
                    'feedback-list',
                    'feedback-edit',
                    'feedback-status-change',
                    'feedback-delete',
                    'experience-level-list',
                    'experience-level-edit',
                    'experience-level-delete',
                    'experience-level-status-change',
                    'experience-level-bulk-delete',
                    'plugin-list',
                    'plugin-add',
                    'plugin-delete',
                    'plugin-status-change',
                    'plugin-status-change',
                    // Security permissions
                    'word-list',
                    'word-add',
                    'word-edit',
                    'word-delete',
                    'word-status-change',
                    'word-bulk-delete',
                    'log-list',
                    'log-delete',
                    'log-bulk-delete',
                    'user-freeze-withdrawal',
                    'user-freeze-project',
                    'user-freeze-job',
                    'user-freeze-new-order',
                    'user-freeze-chat',
                    // Promotion permissions
                    'promotion-menu-access',
                    'project-promote-settings-view',
                    'project-promote-settings-edit',
                    'project-promote-settings-delete',
                    'project-promote-settings-status-change',
                    'promoted-project-list-view',
                    'promoted-project-payment-status-change',
                    'promoted-project-delete',
                    'promoted-profile-list-view',
                    'promoted-profile-payment-status-change',
                    'promoted-profile-delete',
                    'promotion-transaction-fee-settings-view',
                    'promotion-transaction-fee-settings-edit',
                    'promotion-projects-perpage-settings-edit',
                    'promotion-email-settings-view',
                    'promotion-email-settings-edit',
                ];

                foreach ($newPermissions as $permissionName) {
                    $permission = \Spatie\Permission\Models\Permission::where('name', $permissionName)
                        ->where('guard_name', 'admin')
                        ->first();

                    if ($permission && !$superAdminRole->hasPermissionTo($permission)) {
                        $superAdminRole->givePermissionTo($permission);
                    }
                }

                // Clear cached permissions
                app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

                $this->command->info('✓ All permissions assigned to Super Admin role');
            }
        } catch (\Exception $e) {
            $this->command->error('Note: Could not assign permissions to Super Admin role: ' . $e->getMessage());
            $this->command->info('You may need to assign these permissions manually in the admin panel');
        }
    }
}