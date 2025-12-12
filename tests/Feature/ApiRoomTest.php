<?php

namespace Tests\Feature;

use App\Models\Room;
use App\Models\User;
use App\Models\Audit;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiRoomTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_all_rooms(): void
    {
        Room::factory()->count(5)->create();

        $response = $this->getJson('/api/rooms');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'data' => [
                    '*' => ['id', 'name', 'status', 'floor', 'capacity', 'price'],
                ],
            ])
            ->assertJson(['success' => true])
            ->assertJsonCount(5, 'data');
    }

    public function test_get_single_room(): void
    {
        $room = Room::factory()->create([
            'name' => 'Test Room',
            'status' => 'tersedia',
        ]);

        $response = $this->getJson('/api/rooms/' . $room->id);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'data' => [
                    'id' => $room->id,
                    'name' => 'Test Room',
                    'status' => 'tersedia',
                ],
            ]);
    }

    public function test_get_nonexistent_room(): void
    {
        $response = $this->getJson('/api/rooms/99999');

        $response->assertStatus(404)
            ->assertJson(['success' => false]);
    }

    public function test_update_room_status_authenticated(): void
    {
        $user = User::factory()->create(['role' => 'admin']);
        $room = Room::factory()->create(['status' => 'tersedia']);

        $token = $user->createToken('test-token')->plainTextToken;

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->putJson('/api/rooms/' . $room->id, [
                'status' => 'terisi',
            ]);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'data' => ['status' => 'terisi'],
            ]);

        $this->assertDatabaseHas('rooms', [
            'id' => $room->id,
            'status' => 'terisi',
        ]);

        $this->assertDatabaseHas('audits', [
            'room_id' => $room->id,
            'user_id' => $user->id,
            'old_status' => 'tersedia',
            'new_status' => 'terisi',
        ]);
    }

    public function test_update_room_status_unauthenticated(): void
    {
        $room = Room::factory()->create(['status' => 'tersedia']);

        $response = $this->putJson('/api/rooms/' . $room->id, [
            'status' => 'terisi',
        ]);

        $response->assertStatus(401);
    }

    public function test_analytics_endpoint(): void
    {
        $user = User::factory()->create(['role' => 'admin']);

        Room::factory()->count(3)->create(['status' => 'tersedia']);
        Room::factory()->count(2)->create(['status' => 'terisi']);
        Room::factory()->count(1)->create(['status' => 'dibersihkan']);

        $token = $user->createToken('test-token')->plainTextToken;

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->getJson('/api/analytics');

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'data' => [
                    'totalRooms' => 6,
                    'tersedia' => 3,
                    'terisi' => 2,
                    'dibersihkan' => 1,
                ],
            ]);
    }
}
