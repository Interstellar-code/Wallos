<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\WebhookNotification;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class WebhookNotificationSeeder extends Seeder
{
    private array $requiredColumns = [
        'user_id',
        'enabled',
        'webhook_url',
        'auth_type',
        'auth_token',
        'custom_headers',
        'content_type'
    ];

    private array $authTypes = ['basic', 'bearer', 'none'];
    private array $contentTypes = ['application/json', 'application/xml'];

    public function run()
    {
        try {
            $this->validateSchema();
            $this->seedWebhookNotifications();
        } catch (\Exception $e) {
            Log::error('WebhookNotificationSeeder failed: ' . $e->getMessage());
            $this->command->error($e->getMessage());
        }
    }

    private function validateSchema(): void
    {
        if (!Schema::hasTable('webhook_notifications')) {
            throw new \RuntimeException('webhook_notifications table does not exist');
        }

        foreach ($this->requiredColumns as $column) {
            if (!Schema::hasColumn('webhook_notifications', $column)) {
                throw new \RuntimeException("Column $column missing in webhook_notifications table");
            }
        }
    }

    private function seedWebhookNotifications(): void
    {
        // Create webhook notifications for 30% of users
        User::inRandomOrder()
            ->take((int)(User::count() * 0.3))
            ->get()
            ->each(function ($user) {
                $this->createWebhookNotification($user, true);
            });

        // Create some disabled notifications
        User::inRandomOrder()
            ->take(3)
            ->get()
            ->each(function ($user) {
                $this->createWebhookNotification($user, false);
            });
    }

    private function createWebhookNotification(User $user, bool $enabled): void
    {
        $data = [
            'user_id' => $user->id,
            'enabled' => $enabled,
            'webhook_url' => 'https://webhook.site/' . bin2hex(random_bytes(8)),
            'auth_type' => $this->authTypes[array_rand($this->authTypes)],
            'auth_token' => $enabled ? bin2hex(random_bytes(16)) : null,
            'custom_headers' => json_encode(['X-Custom-Header' => 'Value']),
            'content_type' => $this->contentTypes[array_rand($this->contentTypes)],
        ];

        $validator = Validator::make($data, [
            'webhook_url' => 'required|url',
            'auth_type' => ['required', Rule::in($this->authTypes)],
            'content_type' => ['required', Rule::in($this->contentTypes)],
        ]);

        if ($validator->fails()) {
            throw new \RuntimeException('Validation failed: ' . $validator->errors());
        }

        DB::transaction(function () use ($data) {
            WebhookNotification::create($data);
        });
    }
}