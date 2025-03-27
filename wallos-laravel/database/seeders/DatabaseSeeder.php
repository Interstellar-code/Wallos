<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        
        $this->call([
            InitialDataSeeder::class,
            PaymentMethodSeeder::class,
            CategorySeeder::class,
            SubscriptionSeeder::class,
        ]);
        
        Schema::enableForeignKeyConstraints();
    }
}
