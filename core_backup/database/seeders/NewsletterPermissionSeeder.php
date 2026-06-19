<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class NewsletterPermissionSeeder extends Seeder
{
    public function run()
    {
        // Newsletter
        $newsletter_permissions = [
            'newsletter-list',
            'newsletter-send',
            'newsletter-send-all',
            'newsletter-add',
            'newsletter-delete',
        ];

        foreach ($newsletter_permissions as $permission) {
            Permission::updateOrCreate([
                'menu_name' => 'Newsletter',
                'name' => $permission,
                'guard_name' => 'admin'
            ]);
        }
    }
}
