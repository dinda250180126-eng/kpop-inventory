<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Akun Admin
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin K-Store',
                'password' => Hash::make('password123'),
                'role' => 'admin',
            ]
        );

        // Akun Staff
        User::updateOrCreate(
            ['email' => 'staff@gmail.com'],
            [
                'name' => 'Staff Inventory',
                'password' => Hash::make('password123'),
                'role' => 'staff',
            ]
        );
    }
}