<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Seed Admin
        $this->call(AdminSeeder::class);
        // Seed Users
        $this->call(UserSeeder::class);
    }
}
