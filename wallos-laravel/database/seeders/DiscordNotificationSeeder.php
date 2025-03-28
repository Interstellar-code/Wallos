<?php

namespace Database\Seeders;

use App\Models\DiscordNotification;
use App\Models\User;
use Illuminate\Database\Seeder;

class DiscordNotificationSeeder extends Seeder
{
    public function run()
    {
        // Create Discord notifications for 50% of users
        User::inRandomOrder()
            ->take(User::count() / 2)
            ->get()
            ->each(function ($user) {
                DiscordNotification::factory()
                    ->count(rand(1, 2))
                    ->create(['user_id' => $user->id]);
            });

        // Ensure some disabled notifications exist
        User::inRandomOrder()
            ->take(3)
            ->get()
            ->each(function ($user) {
                DiscordNotification::factory()
                    ->disabled()
                    ->create(['user_id' => $user->id]);
            });
    }
}