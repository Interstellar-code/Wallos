<?php

namespace Database\Seeders;

use App\Models\NotificationSettings;
use App\Models\User;
use Illuminate\Database\Seeder;

class NotificationSettingsSeeder extends Seeder
{
    public function run()
    {
        User::all()->each(function ($user) {
            NotificationSettings::factory()->create(['user_id' => $user->id]);
        });
    }
}