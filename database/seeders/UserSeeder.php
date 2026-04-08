<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'email_verified_at' => now(),
            'role' => 'admin',
        ]);

        // Regular users
        $users = [
            [
                'name' => 'Aqila',
                'email' => 'aqila@email.com',
                'phone' => '081234567890',
                'password' => Hash::make('password123'),
                'role' => 'user',
            ],
            [
                'name' => 'Rudi',
                'email' => 'rudi@email.com',
                'phone' => '081234567891',
                'password' => Hash::make('password123'),
                'role' => 'user',
            ],
            [
                'name' => 'Cindy',
                'email' => 'cindy@email.com',
                'phone' => '081234567892',
                'password' => Hash::make('password123'),
                'role' => 'user',
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
