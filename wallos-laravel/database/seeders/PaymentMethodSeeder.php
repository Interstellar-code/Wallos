<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use App\Models\User;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    public function run()
    {
        // Get first user as admin
        $admin = User::first();

        // Create default payment methods for admin
        PaymentMethod::factory()->createMany([
            [
                'user_id' => $admin->id,
                'name' => 'Credit Card',
                'description' => 'Primary credit card'
            ],
            [
                'user_id' => $admin->id,
                'name' => 'Bank Transfer',
                'description' => 'Direct bank transfer'
            ],
            [
                'user_id' => $admin->id,
                'name' => 'PayPal',
                'description' => 'Online payment service'
            ]
        ]);

        // Create payment methods for all users
        User::all()->each(function ($user) {
            PaymentMethod::factory()
                ->count(3)
                ->create(['user_id' => $user->id]);
        });
    }
}
