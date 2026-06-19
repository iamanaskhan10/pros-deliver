<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class SupportTicketPermissionSeeder extends Seeder
{
    public function run()
    {
        // Support ticket bulk action
        Permission::updateOrCreate([
            'menu_name' => 'Support Ticket',
            'name' => 'support-ticket-bulk-delete',
            'guard_name' => 'admin'
        ]);
    }
}
