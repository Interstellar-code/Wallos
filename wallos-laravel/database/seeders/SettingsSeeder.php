<?php

namespace Database\Seeders;

use App\Models\Settings;
use App\Models\User;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    public function run()
    {
        User::all()->each(function ($user) {
            // Alternate between dark and light mode
            $darkMode = $user->id % 2 === 0;
            
            Settings::factory()
                ->when($darkMode, fn($factory) => $factory->darkMode())
                ->create(['user_id' => $user->id]);
        });
    }
}