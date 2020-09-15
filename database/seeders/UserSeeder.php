<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Mahbubur Riad',
            'email' => 'mahbubur.riad@gmail.com',
            'password' => Hash::make('824726Riad'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('teams')->insert([
            'user_id' => '1',
            'name' => "Mahbubur's Team",
            'personal_team' => '1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
