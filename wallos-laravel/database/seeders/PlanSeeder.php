<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    public function run()
    {
        $plans = [
            [
                'name' => 'Basic',
                'price' => 9.99,
                'duration_days' => 30,
                'features' => json_encode(['basic_support', '5GB storage'])
            ],
            [
                'name' => 'Pro',
                'price' => 19.99,
                'duration_days' => 30,
                'features' => json_encode(['priority_support', '50GB storage', 'API access'])
            ],
            [
                'name' => 'Enterprise',
                'price' => 99.99,
                'duration_days' => 365,
                'features' => json_encode(['24/7 support', '1TB storage', 'API access', 'Dedicated account manager'])
            ]
        ];

        foreach ($plans as $plan) {
            Plan::create($plan);
        }
    }
}