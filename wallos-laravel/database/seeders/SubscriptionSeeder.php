<?php

namespace Database\Seeders;

use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class SubscriptionSeeder extends Seeder
{
    public function run(): void
    {
        $subscriptions = [
            [
                'name' => 'Netflix',
                'amount' => 15.99,
                'currency' => 'USD',
                'frequency' => 'monthly',
                'next_payment_date' => Carbon::now()->addMonth(),
                'category_id' => 1,
                'payment_method_id' => 1,
                'user_id' => 1,
                'household_id' => 1
            ],
            [
                'name' => 'Spotify',
                'amount' => 9.99,
                'currency' => 'USD',
                'frequency' => 'monthly',
                'next_payment_date' => Carbon::now()->addMonth(),
                'category_id' => 1,
                'payment_method_id' => 2,
                'user_id' => 1,
                'household_id' => 1
            ],
            [
                'name' => 'Microsoft 365',
                'amount' => 99.00,
                'currency' => 'USD',
                'frequency' => 'yearly',
                'next_payment_date' => Carbon::now()->addYear(),
                'category_id' => 2,
                'payment_method_id' => 1,
                'user_id' => 1,
                'household_id' => 1
            ]
        ];

        foreach ($subscriptions as $subscription) {
            Subscription::create($subscription);
        }
    }
}
