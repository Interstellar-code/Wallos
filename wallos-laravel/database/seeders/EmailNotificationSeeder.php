<?php

namespace Database\Seeders;

use App\Models\EmailNotification;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;

class EmailNotificationSeeder extends Seeder
{
    public function run()
    {
        // Validate table and columns exist
        if (!Schema::hasTable('email_notifications')) {
            Log::error('EmailNotificationSeeder: email_notifications table does not exist');
            return;
        }

        $requiredColumns = [
            'user_id', 'enabled', 'email_address', 
            'smtp_address', 'smtp_port', 'smtp_username',
            'smtp_password'
        ];
        
        foreach ($requiredColumns as $column) {
            if (!Schema::hasColumn('email_notifications', $column)) {
                Log::error("EmailNotificationSeeder: Column $column missing in email_notifications table");
                return;
            }
        }

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