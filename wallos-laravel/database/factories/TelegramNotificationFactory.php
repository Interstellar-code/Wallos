<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TelegramNotificationFactory extends Factory
{
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'enabled' => true,
            'bot_token' => $this->faker->uuid,
            'chat_id' => $this->faker->numerify('##########'),
            'parse_mode' => $this->faker->randomElement(['HTML', 'Markdown', null]),
        ];
    }

    public function disabled()
    {
        return $this->state(function (array $attributes) {
            return [
                'enabled' => false,
            ];
        });
    }
}