<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;

class PublicController extends Controller
{
    /**
     * Homepage
     */
    public function home()
    {
        $stats = [
            'totalRooms' => Room::count(),
            'tersedia' => Room::where('status', 'tersedia')->count(),
            'terisi' => Room::where('status', 'terisi')->count(),
        ];

        $featuredRooms = Room::where('status', 'tersedia')
            ->orderBy('room_type')
            ->take(6)
            ->get();

        return view('user.home', compact('stats', 'featuredRooms'));
    }

    /**
     * Rooms list page
     */
    public function rooms(Request $request)
    {
        $query = Room::query();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('floor')) {
            $query->where('floor', $request->floor);
        }

        $rooms = $query->orderBy('floor')->orderBy('name')->paginate(12);

        $floors = Room::distinct()->pluck('floor')->filter()->sort();

        return view('user.rooms', compact('rooms', 'floors'));
    }

    /**
     * Room detail page
     */
    public function detail($id)
    {
        $room = Room::findOrFail($id);

        $similarRooms = Room::where('id', '!=', $id)
            ->where('status', 'tersedia')
            ->where('room_type', $room->room_type)
            ->take(3)
            ->get();

        return view('user.detail', compact('room', 'similarRooms'));
    }

    /**
     * About page
     */
    public function about()
    {
        return view('user.about');
    }
}
