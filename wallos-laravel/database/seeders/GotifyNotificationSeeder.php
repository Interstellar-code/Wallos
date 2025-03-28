<?php

namespace Database\Seeders;

use App\Models\GotifyNotification;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;

class GotifyNotificationSeeder extends Seeder
{
    public function run()
    {
        // Validate table and columns exist
        if (!Schema::hasTable('gotify_notifications')) {
            Log::error('GotifyNotificationSeeder: gotify_notifications table does not exist');
            return;
        }

        $requiredColumns = [
            'user_id', 'enabled', 'server_url', 
            'app_token', 'priority'
        ];
        
        foreach ($requiredColumns as $column) {
            if (!Schema::hasColumn('gotify_notifications', $column)) {
                Log::error("GotifyNotificationSeeder: Column $column missing in gotify_notifications table");
                return;
            }
        }

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