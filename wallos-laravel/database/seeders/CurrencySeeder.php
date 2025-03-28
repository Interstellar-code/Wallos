<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    public function run()
    {
        // Create common currencies
        Currency::factory()->createMany([
            [
                'name' => 'US Dollar',
                'code' => 'USD',
                'symbol' => '$',
                'enabled' => true
            ],
            [
                'name' => 'Euro',
                'code' => 'EUR',
                'symbol' => '€',
                'enabled' => true
            ],
            [
                'name' => 'British Pound',
                'code' => 'GBP',
                'symbol' => '£',
                'enabled' => true
            ]
        ]);

        // Create additional test currencies
        Currency::factory()->count(5)->create();
    }
}