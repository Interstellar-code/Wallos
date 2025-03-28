<?php

namespace Database\Seeders;

use App\Models\PushoverNotification;
use App\Models\User;
use Illuminate\Database\Seeder;

class PushoverNotificationSeeder extends Seeder
{
    public function run()
    {
        // Create Pushover notifications for 20% of users
        User::inRandomOrder()
            ->take((int)(User::count() * 0.2))
            ->get()
            ->each(function ($user) {
                PushoverNotification::factory()
                    ->create(['user_id' => $user->id]);
            });

        // Ensure some disabled notifications exist
        User::inRandomOrder()
            ->take(2)
            ->get()
            ->each(function ($user) {
                PushoverNotification::factory()
                    ->disabled()
                    ->create(['user_id' => $user->id]);
            });
    }
}