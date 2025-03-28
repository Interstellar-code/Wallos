<?php

namespace Database\Seeders;

use App\Models\WebhookNotification;
use App\Models\User;
use Illuminate\Database\Seeder;

class WebhookNotificationSeeder extends Seeder
{
    public function run()
    {
        // Create webhook notifications for 30% of users
        User::inRandomOrder()
            ->take((int)(User::count() * 0.3))
            ->get()
            ->each(function ($user) {
                WebhookNotification::factory()
                    ->count(rand(1, 2))
                    ->create(['user_id' => $user->id]);
            });

        // Create specific auth type examples
        $authTypes = ['basic', 'bearer', 'custom'];
        foreach ($authTypes as $type) {
            User::inRandomOrder()
                ->first()
                ->webhookNotifications()
                ->create(
                    WebhookNotification::factory()
                        ->make(['auth_type' => $type])
                        ->toArray()
                );
        }
    }
}