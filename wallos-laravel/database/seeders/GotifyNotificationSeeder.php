<?php

namespace Database\Seeders;

use App\Models\GotifyNotification;
use App\Models\User;
use Illuminate\Database\Seeder;

class GotifyNotificationSeeder extends Seeder
{
    public function run()
    {
        // Create Gotify notifications for 30% of users
        User::inRandomOrder()
            ->take((int)(User::count() * 0.3))
            ->get()
            ->each(function ($user) {
                GotifyNotification::factory()
                    ->create(['user_id' => $user->id]);
            });

        // Ensure some disabled notifications exist
        User::inRandomOrder()
            ->take(2)
            ->get()
            ->each(function ($user) {
                GotifyNotification::factory()
                    ->disabled()
                    ->create(['user_id' => $user->id]);
            });
    }
}