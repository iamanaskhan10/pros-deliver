<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (! Schema::hasTable('static_options')) {
            return;
        }

        $option = DB::table('static_options')
            ->where('option_name', 'site_maintenance_mode')
            ->first();

        if ($option) {
            if ($option->option_value === null) {
                DB::table('static_options')
                    ->where('id', $option->id)
                    ->update([
                        'option_value' => '',
                        'updated_at' => now(),
                    ]);
            }

            return;
        }

        DB::table('static_options')->insert([
            'option_name' => 'site_maintenance_mode',
            'option_value' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down()
    {
        //
    }
};
