<?php

namespace Database\Seeders;

use App\Models\PushoverNotification;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;

class PushoverNotificationSeeder extends Seeder
{
    public function run()
    {
        // Validate table and columns exist
        if (!Schema::hasTable('pushover_notifications')) {
            Log::error('PushoverNotificationSeeder: pushover_notifications table does not exist');
            return;
        }

        $requiredColumns = [
            'user_id', 'enabled', 'api_token', 'user_key', 'device', 'priority', 'sound'
        ];
        
        foreach ($requiredColumns as $column) {
            if (!Schema::hasColumn('pushover_notifications', $column)) {
                Log::error("PushoverNotificationSeeder: Column $column missing in pushover_notifications table");
                return;
            }
        }

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