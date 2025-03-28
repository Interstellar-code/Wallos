<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class GotifyNotificationFactory extends Factory
{
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'enabled' => true,
            'server_url' => $this->faker->url,
            'app_token' => $this->faker->uuid,
            'priority' => $this->faker->numberBetween(1, 10),
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