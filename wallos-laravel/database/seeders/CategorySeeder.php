<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Streaming', 'icon' => 'fa-tv'],
            ['name' => 'Software', 'icon' => 'fa-laptop'],
            ['name' => 'Utilities', 'icon' => 'fa-bolt'],
            ['name' => 'Mobile', 'icon' => 'fa-mobile'],
            ['name' => 'Gaming', 'icon' => 'fa-gamepad'],
            ['name' => 'Education', 'icon' => 'fa-graduation-cap'],
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'icon' => $category['icon'],
                'user_id' => 1,
                'household_id' => 1,
                'enabled' => true
            ]);
        }
    }
}
