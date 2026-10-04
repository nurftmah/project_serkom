<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'username' => 'admin',
                'password' => Hash::make('212121'),
                'role' => 'Admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'username' => 'operator',
                'password' => Hash::make('232323'),
                'role' => 'Operator',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
