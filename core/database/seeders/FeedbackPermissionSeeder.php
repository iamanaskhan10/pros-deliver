<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class FeedbackPermissionSeeder extends Seeder
{
    public function run()
    {
        // Feedback
        $feedback_permissions = [
            'feedback-list',
            'feedback-edit',
            'feedback-status-change',
            'feedback-delete',
        ];

        foreach ($feedback_permissions as $permission) {
            Permission::updateOrCreate([
                'menu_name' => 'Feedback',
                'name' => $permission,
                'guard_name' => 'admin'
            ]);
        }
    }
}
