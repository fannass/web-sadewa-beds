<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Audit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class RoomController extends Controller
{
    /**
     * Display rooms list
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

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $rooms = $query->orderBy('floor')->orderBy('name')->paginate(15);

        $floors = Room::distinct()->pluck('floor')->filter()->sort();

        return view('admin.rooms.index', compact('rooms', 'floors'));
    }

    /**
     * Show single room detail
     */
    public function show($id)
    {
        $room = Room::with([
            'audits' => function ($query) {
                $query->with('user')->orderBy('created_at', 'desc')->take(20);
            }
        ])->findOrFail($id);

        return view('admin.rooms.show', compact('room'));
    }

    /**
     * Show create form
     */
    public function create()
    {
        return view('admin.rooms.create');
    }

    /**
     * Store new room
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'room_type' => 'required|string|max:50',
            'status' => ['required', Rule::in(['tersedia', 'terisi', 'dibersihkan'])],
            'floor' => 'nullable|integer|min:1|max:10',
            'bed_count' => 'nullable|integer|min:1|max:10',
            'facilities' => 'nullable|string|max:500',
            'notes' => 'nullable|string|max:1000',
        ]);

        Room::create($validated);

        return redirect()
            ->route('admin.rooms.index')
            ->with('success', 'Kamar berhasil ditambahkan!');
    }

    /**
     * Show edit form
     */
    public function edit($id)
    {
        $room = Room::findOrFail($id);
        return view('admin.rooms.edit', compact('room'));
    }

    /**
     * Update room
     */
    public function update(Request $request, $id)
    {
        $room = Room::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'room_type' => 'required|string|max:50',
            'status' => ['required', Rule::in(['tersedia', 'terisi', 'dibersihkan'])],
            'floor' => 'nullable|integer|min:1|max:10',
            'bed_count' => 'nullable|integer|min:1|max:10',
            'facilities' => 'nullable|string|max:500',
            'notes' => 'nullable|string|max:1000',
        ]);

        $oldStatus = $room->status;

        $room->update($validated);

        // Create audit if status changed
        if ($oldStatus !== $validated['status']) {
            Audit::create([
                'room_id' => $room->id,
                'user_id' => Auth::id(),
                'old_status' => $oldStatus,
                'new_status' => $validated['status'],
                'notes' => 'Status diubah melalui panel admin',
            ]);
        }

        return redirect()
            ->route('admin.rooms.index')
            ->with('success', 'Kamar berhasil diperbarui!');
    }

    /**
     * Update room status only (AJAX)
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => ['required', Rule::in(['tersedia', 'terisi', 'dibersihkan'])],
        ]);

        $room = Room::findOrFail($id);
        $oldStatus = $room->status;

        $room->update(['status' => $request->status]);

        // Create audit log
        Audit::create([
            'room_id' => $room->id,
            'user_id' => Auth::id(),
            'old_status' => $oldStatus,
            'new_status' => $request->status,
            'notes' => $request->notes ?? 'Perubahan status cepat',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Status berhasil diperbarui',
            'room' => $room->fresh(),
        ]);
    }

    /**
     * Delete room
     */
    public function destroy($id)
    {
        $room = Room::findOrFail($id);
        $room->delete();

        return redirect()
            ->route('admin.rooms.index')
            ->with('success', 'Kamar berhasil dihapus!');
    }
}
