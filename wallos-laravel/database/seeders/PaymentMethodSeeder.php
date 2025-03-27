<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentMethodSeeder extends Seeder
{
    public function run(): void
    {
        $methods = [
            ['name' => 'Credit Card', 'icon' => 'fa-credit-card', 'user_id' => 1, 'household_id' => 1, 'enabled' => true],
            ['name' => 'PayPal', 'icon' => 'fa-paypal', 'user_id' => 1, 'household_id' => 1, 'enabled' => true],
            ['name' => 'Bank Transfer', 'icon' => 'fa-university', 'user_id' => 1, 'household_id' => 1, 'enabled' => true],
            ['name' => 'Cash', 'icon' => 'fa-money-bill-wave', 'user_id' => 1, 'household_id' => 1, 'enabled' => true],
            ['name' => 'Debit Card', 'icon' => 'fa-credit-card', 'user_id' => 1, 'household_id' => 1, 'enabled' => true],
        ];

        DB::table('payment_methods')->insert($methods);
    }
}
