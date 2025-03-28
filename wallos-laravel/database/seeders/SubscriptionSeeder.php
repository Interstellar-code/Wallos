<?php

namespace Database\Seeders;

use App\Models\Subscription;
use App\Models\User;
use App\Models\Plan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class SubscriptionSeeder extends Seeder
{
    public function run()
    {
        try {
            User::all()->each(function ($user) {
                if (!$this->hasRequiredRelations($user)) {
                    Log::warning("Skipping subscriptions for user {$user->id} - missing required relations");
                    return;
                }

                // Create 3-5 active subscriptions per user
                $this->createSubscriptions($user, rand(3, 5), true);

                // Create 1-2 inactive subscriptions per user
                $this->createSubscriptions($user, rand(1, 2), false);
            });
        } catch (\Exception $e) {
            Log::error('SubscriptionSeeder failed: ' . $e->getMessage());
            $this->command->error($e->getMessage());
        }
    }

    private function hasRequiredRelations(User $user): bool
    {
        return $user->currencies->isNotEmpty() 
            && $user->categories->isNotEmpty()
            && $user->paymentMethods->isNotEmpty()
            && Plan::exists();
    }

    private function createSubscriptions(User $user, int $count, bool $active): void
    {
        $billingCycles = ['monthly', 'yearly', 'quarterly', 'weekly'];
        $popularServices = [
            'Netflix', 'Spotify', 'YouTube Premium', 'Microsoft 365',
            'Adobe Creative Cloud', 'Dropbox', 'AWS', 'DigitalOcean'
        ];

        Subscription::factory()
            ->when(!$active, fn($factory) => $factory->inactive())
            ->count($count)
            ->create([
                'user_id' => $user->id,
                'payer_user_id' => $user->household_id ? $user->household->user_id : $user->id,
                'name' => fake()->randomElement($popularServices),
                'description' => fake()->sentence(),
                'amount' => fake()->randomFloat(2, 5, 100),
                'currency_id' => $user->currencies->random()->id,
                'category_id' => $user->categories->random()->id,
                'payment_method_id' => $user->paymentMethods->random()->id,
                'plan_id' => Plan::inRandomOrder()->first()->id,
                'billing_cycle' => fake()->randomElement($billingCycles),
                'next_payment_date' => $active ? fake()->dateTimeBetween('now', '+1 year') : fake()->dateTimeBetween('-1 year', 'now'),
                'last_payment' => $active ? fake()->dateTimeBetween('-1 year', 'now') : null,
                'website' => fake()->url(),
                'logo' => null,
                'notes' => fake()->boolean(30) ? fake()->paragraph() : null,
                'inactive' => !$active
            ]);
    }
}
