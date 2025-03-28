<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SettingsFactory extends Factory
{
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'language' => 'en',
            'timezone' => 'UTC',
            'date_format' => 'Y-m-d',
            'time_format' => 'H:i',
            'currency_format' => 'symbol',
            'first_day_of_week' => 1,
            'dark_mode' => false,
        ];
    }

    public function darkMode()
    {
        return $this->state(function (array $attributes) {
            return [
                'dark_mode' => true,
            ];
        });
    }
}