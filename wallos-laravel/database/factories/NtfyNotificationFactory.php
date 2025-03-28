<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class NtfyNotificationFactory extends Factory
{
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'enabled' => true,
            'server_url' => $this->faker->url,
            'topic' => $this->faker->word,
            'priority' => $this->faker->numberBetween(1, 5),
            'auth_token' => $this->faker->optional()->uuid,
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