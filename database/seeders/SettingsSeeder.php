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
            'settings_value' => 'Covid19 - CoronaVirus Pandemic',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('settings')->insert([
            'settings_key' => 'website_email',
            'settings_value' => 'info@saltanatglobal.com',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('settings')->insert([
            'settings_key' => 'address',
            'settings_value' => 'House 108, Apt C2, Road 11 Road # 28, Block # C, Banani, Dhaka 1213',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('settings')->insert([
            'settings_key' => 'mobile',
            'settings_value' => '01311311655',
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
            'settings_value' => 'All rights reserved - Saltanat Global Limited',
            'created_at' => now(),
            'updated_at' => now(),

        ]);
        DB::table('settings')->insert([
            'settings_key' => 'footer_text_right',
            'settings_value' => 'Covid19 - CoronaVirus Pandemic Control Panel',
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
