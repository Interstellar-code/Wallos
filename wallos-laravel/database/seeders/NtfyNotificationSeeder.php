<?php

namespace Database\Seeders;

use App\Models\NtfyNotification;
use App\Models\User;
use Illuminate\Database\Seeder;

class NtfyNotificationSeeder extends Seeder
{
    public function run()
    {
        // Create Ntfy notifications for 25% of users
        User::inRandomOrder()
            ->take((int)(User::count() * 0.25))
            ->get()
            ->each(function ($user) {
                NtfyNotification::factory()
                    ->create(['user_id' => $user->id]);
            });

        // Ensure some disabled notifications exist
        User::inRandomOrder()
            ->take(2)
            ->get()
            ->each(function ($user) {
                NtfyNotification::factory()
                    ->disabled()
                    ->create(['user_id' => $user->id]);
            });
    }
}