<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PortfolioPermissionSeeder extends Seeder
{
    public function run()
    {
        // Portfolio settings
        Permission::updateOrCreate([
            'menu_name' => 'Portfolio',
            'name' => 'portfolio-auto-approval',
            'guard_name' => 'admin'
        ]);
    }
}
