<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TwoFactorAuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_2fa_verification()
    {
        /** @var User $user */
        $user = User::factory()->create([
            'two_factor_enabled' => true,
            'two_factor_secret' => 'TEST_SECRET'
        ]);

        $response = $this->actingAs($user)
            ->post('/login', [
                'email' => $user->email,
                'password' => 'password'
            ]);

        $response->assertRedirect('/2fa/verify');

        // Test with invalid code
        $response = $this->post('/2fa/verify', [
            'code' => '000000'
        ]);
        $response->assertSessionHasErrors();

        // Test with valid code (mock verification)
        $this->mock(\OTPHP\TOTP::class, function ($mock) {
            $mock->shouldReceive('verify')->andReturn(true);
        });

        $response = $this->post('/2fa/verify', [
            'code' => '123456'
        ]);
        $response->assertRedirect('/');
    }

    public function test_recovery_codes()
    {
        /** @var User $user */
        $user = User::factory()->create([
            'two_factor_enabled' => true
        ]);

        $response = $this->actingAs($user)
            ->get('/2fa/recovery');
        
        $response->assertOk();
        $response->assertViewHas('codes');
    }
}