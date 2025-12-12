<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RoomType;
use Illuminate\Http\Request;

class RoomTypeController extends Controller
{
    public function index()
    {
        $roomTypes = RoomType::orderBy('sort_order')->orderBy('name')->get();
        return view('admin.room-types.index', compact('roomTypes'));
    }

    public function create()
    {
        return view('admin.room-types.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:room_types,name',
            'description' => 'nullable|string|max:500',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        RoomType::create([
            'name' => $request->name,
            'description' => $request->description,
            'sort_order' => $request->sort_order ?? 0,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.room-types.index')
            ->with('success', 'Tipe kamar berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $roomType = RoomType::findOrFail($id);
        return view('admin.room-types.edit', compact('roomType'));
    }

    public function update(Request $request, $id)
    {
        $roomType = RoomType::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:room_types,name,' . $id,
            'description' => 'nullable|string|max:500',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $roomType->update([
            'name' => $request->name,
            'description' => $request->description,
            'sort_order' => $request->sort_order ?? 0,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.room-types.index')
            ->with('success', 'Tipe kamar berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $roomType = RoomType::findOrFail($id);

        // Check if room type is in use
        $roomsCount = \App\Models\Room::where('room_type', $roomType->name)->count();
        if ($roomsCount > 0) {
            return redirect()->route('admin.room-types.index')
                ->with('error', "Tipe kamar tidak dapat dihapus karena digunakan oleh {$roomsCount} kamar.");
        }

        $roomType->delete();

        return redirect()->route('admin.room-types.index')
            ->with('success', 'Tipe kamar berhasil dihapus!');
    }
}
