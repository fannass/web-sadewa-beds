<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiAuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_api_with_valid_credentials(): void
    {
        $user = User::factory()->create([
            'username' => 'testadmin',
            'password' => bcrypt('TestPass123!'),
            'role' => 'admin',
        ]);

        $response = $this->postJson('/api/login', [
            'username' => 'testadmin',
            'password' => 'TestPass123!',
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'token',
                'user' => ['id', 'username', 'name', 'email', 'role'],
            ])
            ->assertJson(['success' => true]);
    }

    public function test_login_api_with_invalid_credentials(): void
    {
        $user = User::factory()->create([
            'username' => 'testadmin',
            'password' => bcrypt('TestPass123!'),
        ]);

        $response = $this->postJson('/api/login', [
            'username' => 'testadmin',
            'password' => 'wrongpassword',
        ]);

        $response->assertStatus(401)
            ->assertJson(['success' => false]);
    }

    public function test_logout_api(): void
    {
        $user = User::factory()->create([
            'username' => 'testadmin',
            'password' => bcrypt('TestPass123!'),
        ]);

        $token = $user->createToken('test-token')->plainTextToken;

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->postJson('/api/logout');

        $response->assertStatus(200)
            ->assertJson(['success' => true]);
    }

    public function test_me_api(): void
    {
        $user = User::factory()->create([
            'username' => 'testadmin',
        ]);

        $token = $user->createToken('test-token')->plainTextToken;

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->getJson('/api/me');

        $response->assertStatus(200)
            ->assertJson(['success' => true]);
    }
}
