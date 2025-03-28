<?php

namespace Database\Seeders;

use App\Models\NtfyNotification;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;

class NtfyNotificationSeeder extends Seeder
{
    public function run()
    {
        // Validate table and columns exist
        if (!Schema::hasTable('ntfy_notifications')) {
            Log::error('NtfyNotificationSeeder: ntfy_notifications table does not exist');
            return;
        }

        $requiredColumns = ['user_id', 'enabled', 'server_url', 'topic', 'priority', 'auth_token'];
        foreach ($requiredColumns as $column) {
            if (!Schema::hasColumn('ntfy_notifications', $column)) {
                Log::error("NtfyNotificationSeeder: Column $column missing in ntfy_notifications table");
                return;
            }
        }

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