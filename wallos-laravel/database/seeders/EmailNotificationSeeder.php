<?php

namespace Database\Seeders;

use App\Models\EmailNotification;
use App\Models\User;
use Illuminate\Database\Seeder;

class EmailNotificationSeeder extends Seeder
{
    public function run()
    {
        User::all()->each(function ($user) {
            // Create 1-3 email notifications per user
            EmailNotification::factory()
                ->count(rand(1, 3))
                ->create(['user_id' => $user->id]);

            // Ensure at least one disabled notification
            EmailNotification::factory()
                ->disabled()
                ->create(['user_id' => $user->id]);
        });
    }
}