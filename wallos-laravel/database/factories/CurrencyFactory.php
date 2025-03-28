<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CurrencyFactory extends Factory
{
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'name' => $this->faker->currencyCode,
            'code' => $this->faker->currencyCode,
            'symbol' => $this->faker->currencyCode,
            'rate' => $this->faker->randomFloat(4, 0.5, 1.5),
            'is_primary' => false,
            'enabled' => true,
        ];
    }

    public function primary()
    {
        return $this->state(function (array $attributes) {
            return [
                'is_primary' => true,
            ];
        });
    }
}