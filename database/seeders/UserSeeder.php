<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'role_id' => 1 // Admin
        ]);

        User::create([
            'name' => 'Logan',
            'email' => 'logan@gmail.com',
            'password' => bcrypt('password'),
            'role_id' => 2 // Editor role (role_id 2 for Editor)
        ]);

        User::create([
            'name' => 'Tester1',
            'email' => 'tester1@gmail.com',
            'password' => bcrypt('password'),
            'role_id' => 3 // Normal User role (role_id 3 for Normal User)
        ]);
    }
}
