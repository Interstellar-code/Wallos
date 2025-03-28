<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class WebhookNotificationFactory extends Factory
{
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'enabled' => true,
            'webhook_url' => $this->faker->url,
            'auth_type' => $this->faker->randomElement(['none', 'basic', 'bearer', 'custom']),
            'auth_token' => $this->faker->optional()->uuid,
            'custom_headers' => $this->faker->optional()->word,
            'content_type' => $this->faker->randomElement(['application/json', 'application/xml']),
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