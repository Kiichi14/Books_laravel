<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class ManageApiUserTest extends TestCase
{

    use RefreshDatabase;
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $this->assertTrue(true);
    }

    public function test_all_user_can_register(): void
    {
        $response = $this->post('/api/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        $response->assertOk();
    }

    public function test_user_api_connect(): void
    {
        $user = User::factory()->create();

        $response = $this->post('/api/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
    }

    public function test_user_cannot_connect_with_wrong_password(): void
    {
        $user = User::factory()->create();

        $response = $this->post('/api/login', [
            'email' => $user->email,
            'password' => Str::random(6)
        ]);

        $this->assertGuest();
    }

    public function test_user_cannot_connect_with_wrong_email(): void
    {
        $user = User::factory()->create();

        $response = $this->post('/api/login', [
            'email' => Str::random(6),
            'password' => 'password'
        ]);

        $this->assertGuest();
    }
}
