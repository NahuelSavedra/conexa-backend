<?php

namespace Tests\Unit\api;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_with_valid_credentials()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password123'),
        ]);

        $response = $this->post('/api/login', [
            'email' => 'test@example.com',
            'password' => 'password123',
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'token',
                'token_type',
                'expires_in',
            ],
        ]);
    }

    public function test_login_with_invalid_credentials()
    {
        $response = $this->post('/api/login', [
            'email' => 'invalid@example.com',
            'password' => 'invalidpassword',
        ]);

        $response->assertStatus(401);
    }

    public function test_register()
    {
        $userData = [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        $response = $this->post('/api/register', $userData);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'token',
                'token_type',
                'expires_in',
            ],
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'johndoe@example.com',
        ]);
    }
}
