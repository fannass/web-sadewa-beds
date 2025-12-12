<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Audit;
use Carbon\Carbon;

class AnalyticsController extends Controller
{
    public function index()
    {
        $totalRooms = Room::count();
        $tersedia = Room::where('status', 'tersedia')->count();
        $terisi = Room::where('status', 'terisi')->count();
        $dibersihkan = Room::where('status', 'dibersihkan')->count();

        // Daily data for chart
        $dailyData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $dailyData[] = [
                'date' => $date->format('d M'),
                'changes' => Audit::whereDate('created_at', $date)->count(),
            ];
        }

        // Floor data
        $floors = Room::distinct()->pluck('floor')->filter()->sort();
        $floorData = [];
        foreach ($floors as $floor) {
            $floorData[] = [
                'floor' => $floor,
                'tersedia' => Room::where('floor', $floor)->where('status', 'tersedia')->count(),
                'terisi' => Room::where('floor', $floor)->where('status', 'terisi')->count(),
                'dibersihkan' => Room::where('floor', $floor)->where('status', 'dibersihkan')->count(),
            ];
        }

        // Calculate average occupancy (7 days)
        $weekAudits = Audit::where('created_at', '>=', now()->subDays(7))->count();
        $avgOccupancy = $totalRooms > 0 ? round(($terisi / $totalRooms) * 100) : 0;

        $analytics = [
            'avgOccupancy' => $avgOccupancy,
            'totalChanges' => $weekAudits,
            'activeRooms' => $totalRooms,
            'todayChanges' => Audit::whereDate('created_at', today())->count(),
            'availabilityRate' => $totalRooms > 0 ? round(($tersedia / $totalRooms) * 100) : 0,
            'dailyData' => $dailyData,
            'statusData' => [
                'tersedia' => $tersedia,
                'terisi' => $terisi,
                'dibersihkan' => $dibersihkan,
            ],
            'floorData' => $floorData,
        ];

        return view('admin.analytics', compact('analytics'));
    }
}
