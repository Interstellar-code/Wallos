<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PushoverNotificationFactory extends Factory
{
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'enabled' => true,
            'api_token' => $this->faker->uuid,
            'user_key' => $this->faker->uuid,
            'device' => $this->faker->optional()->word,
            'priority' => $this->faker->numberBetween(-2, 2),
            'sound' => $this->faker->optional()->word,
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