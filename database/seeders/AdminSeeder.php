<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // Seed Admin
        if (!User::where('email', 'BarangayCobol@gmail.com')->exists()) {
            User::create([
                'name' => 'Barangay Admin',
                'email' => 'BarangayCobol@gmail.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

    }
}
