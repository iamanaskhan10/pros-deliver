<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class BlogPermissionSeeder extends Seeder
{
    public function run()
    {
        $blog_permissions = [
            'blog-list',
            'blog-add',
            'blog-edit',
            'blog-delete',
        ];

        foreach ($blog_permissions as $permission) {
            Permission::updateOrCreate([
                'menu_name' => 'Blog Manage',
                'name' => $permission,
                'guard_name' => 'admin'
            ]);
        }
    }
}
