<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Audit;
use Illuminate\Validation\Rule;

class RoomController extends Controller
{
    /**
     * Get all rooms
     */
    public function index(Request $request)
    {
        $query = Room::query();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('floor')) {
            $query->where('floor', $request->floor);
        }

        if ($request->filled('room_type')) {
            $query->where('room_type', $request->room_type);
        }

        $rooms = $query->orderBy('floor')->orderBy('name')->get();

        return response()->json([
            'success' => true,
            'data' => $rooms,
        ]);
    }

    /**
     * Get single room
     */
    public function show($id)
    {
        $room = Room::find($id);

        if (!$room) {
            return response()->json([
                'success' => false,
                'message' => 'Kamar tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $room,
        ]);
    }

    /**
     * Update room status (requires auth)
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => ['required', Rule::in(['tersedia', 'terisi', 'dibersihkan'])],
            'notes' => 'nullable|string|max:500',
        ]);

        $room = Room::find($id);

        if (!$room) {
            return response()->json([
                'success' => false,
                'message' => 'Kamar tidak ditemukan',
            ], 404);
        }

        $oldStatus = $room->status;
        $room->update(['status' => $request->status]);

        // Create audit log
        Audit::create([
            'room_id' => $room->id,
            'user_id' => auth()->id(),
            'old_status' => $oldStatus,
            'new_status' => $request->status,
            'notes' => $request->notes ?? 'Perubahan via API',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Status kamar berhasil diperbarui',
            'data' => $room->fresh(),
        ]);
    }

    /**
     * Get statistics/analytics (requires auth)
     */
    public function analytics()
    {
        $totalRooms = Room::count();
        $tersedia = Room::where('status', 'tersedia')->count();
        $terisi = Room::where('status', 'terisi')->count();
        $dibersihkan = Room::where('status', 'dibersihkan')->count();

        $occupancyRate = $totalRooms > 0
            ? round(($terisi / $totalRooms) * 100, 1)
            : 0;

        return response()->json([
            'success' => true,
            'data' => [
                'totalRooms' => $totalRooms,
                'tersedia' => $tersedia,
                'terisi' => $terisi,
                'dibersihkan' => $dibersihkan,
                'occupancyRate' => $occupancyRate,
            ],
        ]);
    }
}
