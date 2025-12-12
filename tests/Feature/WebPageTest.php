<?php

namespace Tests\Feature;

use App\Models\Room;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WebPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_loads(): void
    {
        Room::factory()->count(3)->create(['status' => 'tersedia']);

        $response = $this->get('/');

        $response->assertStatus(200)
            ->assertSee('Sadewa Beds');
    }

    public function test_rooms_page_loads(): void
    {
        Room::factory()->count(5)->create();

        $response = $this->get('/rooms');

        $response->assertStatus(200);
    }

    public function test_room_detail_page_loads(): void
    {
        $room = Room::factory()->create(['name' => 'Test Room']);

        $response = $this->get('/rooms/' . $room->id);

        $response->assertStatus(200)
            ->assertSee('Test Room');
    }

    public function test_admin_dashboard_requires_auth(): void
    {
        $response = $this->get('/admin/dashboard');

        $response->assertRedirect('/login');
    }

    public function test_admin_dashboard_requires_admin_role(): void
    {
        $user = User::factory()->create(['role' => 'user']);

        $response = $this->actingAs($user)->get('/admin/dashboard');

        $response->assertStatus(403);
    }

    public function test_admin_dashboard_accessible_by_admin(): void
    {
        $user = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($user)->get('/admin/dashboard');

        $response->assertStatus(200);
    }

    public function test_admin_rooms_page_loads(): void
    {
        $user = User::factory()->create(['role' => 'admin']);
        Room::factory()->count(5)->create();

        $response = $this->actingAs($user)->get('/admin/rooms');

        $response->assertStatus(200);
    }
}
