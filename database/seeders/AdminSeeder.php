<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          DB::table('admin')->insert([
            'name' => 'SR LARAVEL DEVLOPER CHETAN SARLIYA',
            'email' => 'chetansarliya@gmail.com',
            'mobile' => '8000750498',
            'password' => Hash::make('123456789'), 
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
