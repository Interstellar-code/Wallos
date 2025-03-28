<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class NotificationSettingsFactory extends Factory
{
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'notify_before' => 3,
            'notify_before_unit' => 'days',
            'notify_on_day' => true,
            'notify_after' => 1,
            'notify_after_unit' => 'days',
            'notify_on_failure' => true,
            'notify_on_new_device' => true,
            'notify_on_password_change' => true,
        ];
    }
}