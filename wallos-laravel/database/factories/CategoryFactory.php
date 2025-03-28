<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Household;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'household_id' => null,
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'color' => $this->faker->hexColor,
            'enabled' => true,
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