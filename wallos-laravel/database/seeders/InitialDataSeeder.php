<?php

namespace Database\Seeders;

use App\Models\Household;
use App\Models\User;
use Illuminate\Database\Seeder;

class InitialDataSeeder extends Seeder
{
    public function run(): void
    {
        // First create household with null user_id
        $household = Household::create([
            'name' => 'Test Household',
            'email' => 'test@example.com',
            'user_id' => null
        ]);

        // Then create user with all required fields
        $user = User::create([
            'name' => 'Admin User',
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'household_id' => $household->id,
            'main_currency' => 'USD',
            'language' => 'en',
            'two_factor_enabled' => false
        ]);

        // Finally update household with user_id
        $household->update(['user_id' => $user->id]);
    }
}