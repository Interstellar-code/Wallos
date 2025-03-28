<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Currency;
use App\Models\Household;
use App\Models\PaymentMethod;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubscriptionFactory extends Factory
{
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'name' => $this->faker->company,
            'description' => $this->faker->sentence,
            'amount' => $this->faker->randomFloat(2, 1, 100),
            'currency_id' => Currency::factory(),
            'category_id' => Category::factory(),
            'payment_method_id' => PaymentMethod::factory(),
            'payer_user_id' => Household::factory(),
            'billing_cycle' => $this->faker->randomElement(['monthly', 'yearly', 'weekly']),
            'next_payment' => $this->faker->dateTimeBetween('now', '+1 year'),
            'last_payment' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'inactive' => false,
            'website' => $this->faker->url,
            'logo' => null,
            'notes' => $this->faker->paragraph,
        ];
    }

    public function inactive()
    {
        return $this->state(function (array $attributes) {
            return [
                'inactive' => true,
            ];
        });
    }
}