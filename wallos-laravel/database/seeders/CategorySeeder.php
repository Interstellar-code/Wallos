<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        // Get first user as admin
        $admin = User::first();

        // Create default categories for admin
        Category::factory()->createMany([
            [
                'user_id' => $admin->id,
                'household_id' => null,
                'name' => 'Utilities',
                'color' => '#FF5733'
            ],
            [
                'user_id' => $admin->id,
                'name' => 'Entertainment',
                'color' => '#33FF57'
            ],
            [
                'user_id' => $admin->id,
                'name' => 'Food',
                'color' => '#3357FF'
            ]
        ]);

        // Create categories for all users
        User::all()->each(function ($user) {
            Category::factory()
                ->count(3)
                ->create(['user_id' => $user->id]);
        });
    }
}
