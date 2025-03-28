<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class DiscordNotificationFactory extends Factory
{
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'enabled' => true,
            'webhook_url' => 'https://discord.com/api/webhooks/' . $this->faker->uuid,
            'bot_name' => $this->faker->word,
            'bot_avatar' => null,
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