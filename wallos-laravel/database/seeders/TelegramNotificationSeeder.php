<?php

namespace Database\Seeders;

use App\Models\TelegramNotification;
use App\Models\User;
use Illuminate\Database\Seeder;

class TelegramNotificationSeeder extends Seeder
{
    public function run()
    {
        // Create Telegram notifications for 40% of users
        User::inRandomOrder()
            ->take((int)(User::count() * 0.4))
            ->get()
            ->each(function ($user) {
                TelegramNotification::factory()
                    ->count(rand(1, 2))
                    ->create(['user_id' => $user->id]);
            });

        // Ensure some disabled notifications exist
        User::inRandomOrder()
            ->take(3)
            ->get()
            ->each(function ($user) {
                TelegramNotification::factory()
                    ->disabled()
                    ->create(['user_id' => $user->id]);
            });
    }
}