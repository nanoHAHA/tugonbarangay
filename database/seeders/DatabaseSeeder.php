<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@tugonbarangay.ph'],
            [
                'name' => 'Hon. Axel James B. Cantes',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                
            ]
        );

        User::updateOrCreate(
            ['email' => 'staff@tugonbarangay.ph'],
            [
                'name' => 'Maria Clara Santos',
                'password' => Hash::make('password123'),
                'role' => 'staff',
                
            ]
        );
    }
}