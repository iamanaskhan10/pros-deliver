<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class CreditPermissionSeeder extends Seeder
{
    public function run()
    {
        // Credit
        $credit_permissions = [
            'credit-list',
            'credit-history-details',
            'credit-complete-manual-deposit-status',
        ];

        foreach ($credit_permissions as $permission) {
            Permission::updateOrCreate([
                'menu_name' => 'Credit',
                'name' => $permission,
                'guard_name' => 'admin'
            ]);
        }
    }
}
