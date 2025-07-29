<?php

namespace Database\Seeders;

use App\Domain\User\Entities\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin User
        User::create([
            'username' => 'admin',
            'name' => 'Administrator',
            'email' => 'admin@apotek.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'phone' => '08123456789',
            'address' => 'Jl. Admin No. 1, Jakarta',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        // Create Apoteker User
        User::create([
            'username' => 'apoteker',
            'name' => 'Apoteker',
            'email' => 'apoteker@apotek.com',
            'password' => Hash::make('apoteker123'),
            'role' => 'pharmacist',
            'phone' => '08123456788',
            'address' => 'Jl. Apoteker No. 1, Jakarta',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        // Create Sample Pelanggan
        User::create([
            'username' => 'pelanggan',
            'name' => 'Pelanggan Sample',
            'email' => 'pelanggan@apotek.com',
            'password' => Hash::make('pelanggan123'),
            'role' => 'buyer',
            'phone' => '08123456787',
            'address' => 'Jl. Pelanggan No. 1, Jakarta',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);
    }
} 