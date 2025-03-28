<?php

namespace Database\Seeders;

use App\Models\DiscordNotification;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;

class DiscordNotificationSeeder extends Seeder
{
    public function run()
    {
        // Validate table and columns exist
        if (!Schema::hasTable('discord_notifications')) {
            Log::error('DiscordNotificationSeeder: discord_notifications table does not exist');
            return;
        }

        $requiredColumns = [
            'user_id', 'enabled', 'webhook_url', 'bot_name'
        ];
        
        foreach ($requiredColumns as $column) {
            if (!Schema::hasColumn('discord_notifications', $column)) {
                Log::error("DiscordNotificationSeeder: Column $column missing in discord_notifications table");
                return;
            }
        }

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