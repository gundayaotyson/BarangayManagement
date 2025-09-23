<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create BHW user
        User::create([
            'name' => 'BHW User',
            'email' => 'bhw@example.com',
            'password' => Hash::make('password'),
            'role' => 'BHW',
        ]);

        // Create Senior user
        User::create([
            'name' => 'Senior User',
            'email' => 'senior@example.com',
            'password' => Hash::make('password'),
            'role' => 'Senior',
        ]);

        // Create 4ps user
        User::create([
            'name' => '4ps User',
            'email' => '4ps@example.com',
            'password' => Hash::make('password'),
            'role' => '4ps',
        ]);
    }
}
