<?php
// database/seeders/UserSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Create static users
        $users = [
            [
                'name' => 'SKUser',
                'email' => 'skchairnman@gmail.com',
                'password' => Hash::make('skadmin123'),
                'role' => 'user',
                'image' => null,
            ]

            // Add more users as needed
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
