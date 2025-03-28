<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UserSeeder::class,
            CurrencySeeder::class,
            CategorySeeder::class,
            PaymentMethodSeeder::class,
            HouseholdSeeder::class,
            SettingsSeeder::class,
            NotificationSettingsSeeder::class,
            PlanSeeder::class,
            EmailNotificationSeeder::class,
            DiscordNotificationSeeder::class,
            GotifyNotificationSeeder::class,
            NtfyNotificationSeeder::class,
            PushoverNotificationSeeder::class,
            TelegramNotificationSeeder::class,
            WebhookNotificationSeeder::class,
            SubscriptionSeeder::class,
        ]);
    }
}
