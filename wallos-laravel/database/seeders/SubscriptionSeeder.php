<?php

namespace Database\Seeders;

use App\Models\Subscription;
use App\Models\User;
use Illuminate\Database\Seeder;

class SubscriptionSeeder extends Seeder
{
    public function run()
    {
        User::all()->each(function ($user) {
            // Create 3-5 subscriptions per user
            Subscription::factory()
                ->count(rand(3, 5))
                ->create([
                    'user_id' => $user->id,
                    'currency_id' => $user->currencies->random()->id,
                    'category_id' => $user->categories->random()->id,
                    'payment_method_id' => $user->paymentMethods->random()->id
                ]);

            // Create some inactive subscriptions
            Subscription::factory()
                ->inactive()
                ->count(rand(1, 2))
                ->create([
                    'user_id' => $user->id,
                    'currency_id' => $user->currencies->random()->id,
                    'category_id' => $user->categories->random()->id,
                    'payment_method_id' => $user->paymentMethods->random()->id
                ]);
        });
    }
}
