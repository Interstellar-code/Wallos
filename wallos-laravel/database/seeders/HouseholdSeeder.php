<?php

namespace Database\Seeders;

use App\Models\Household;
use App\Models\User;
use Illuminate\Database\Seeder;

class HouseholdSeeder extends Seeder
{
    public function run()
    {
        // Get all users
        $users = User::all();

        // Create households for each user
        $users->each(function ($user) {
            Household::factory()
                ->count(2)
                ->create(['user_id' => $user->id]);
        });

        // Create shared household for first 3 users
        if ($users->count() >= 3) {
            $sharedHousehold = Household::factory()->create([
                'name' => 'Shared Household',
                'email' => 'shared@example.com'
            ]);

            $users->take(3)->each(function ($user) use ($sharedHousehold) {
                $user->update(['household_id' => $sharedHousehold->id]);
            });
        }
    }
}