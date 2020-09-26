<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            'settings_key' => 'website_title',
            'settings_value' => 'ERP Solution',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('settings')->insert([
            'settings_key' => 'website_email',
            'settings_value' => 'demo@gmail.com',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('settings')->insert([
            'settings_key' => 'address',
            'settings_value' => 'demo@gmail.com',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('settings')->insert([
            'settings_key' => 'mobile',
            'settings_value' => '01711155222',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('settings')->insert([
            'settings_key' => 'website',
            'settings_value' => 'http://localhost:8000',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('settings')->insert([
            'settings_key' => 'footer_text_left',
            'settings_value' => 'Example All rights reserved.',
            'created_at' => now(),
            'updated_at' => now(),

        ]);
        DB::table('settings')->insert([
            'settings_key' => 'footer_text_right',
            'settings_value' => 'Something Footer Text Right',
            'created_at' => now(),
            'updated_at' => now(),

        ]);
        DB::table('settings')->insert([
            'settings_key' => 'logo',
            'settings_value' => '',
            'created_at' => now(),
            'updated_at' => now(),

        ]);
        DB::table('settings')->insert([
            'settings_key' => 'favicon',
            'settings_value' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
