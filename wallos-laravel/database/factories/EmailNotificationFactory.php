<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmailNotificationFactory extends Factory
{
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'enabled' => true,
            'email_address' => $this->faker->safeEmail,
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