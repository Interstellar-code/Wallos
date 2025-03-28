<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    public function definition()
    {
        return [
            'username' => $this->faker->unique()->userName,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password'),
            'api_key' => Str::random(32),
            'is_admin' => false,
            'email_verified' => true,
            'totp_enabled' => false,
            'totp_secret' => null,
        ];
    }

    public function admin()
    {
        return $this->state(function (array $attributes) {
            return [
                'is_admin' => true,
            ];
        });
    }

    public function withTotp()
    {
        return $this->state(function (array $attributes) {
            return [
                'totp_enabled' => true,
                'totp_secret' => 'JBSWY3DPEHPK3PXP',
            ];
        });
    }
}
