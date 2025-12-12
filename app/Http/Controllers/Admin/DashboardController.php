<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Audit;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalRooms = Room::count();
        $tersedia = Room::where('status', 'tersedia')->count();
        $terisi = Room::where('status', 'terisi')->count();
        $dibersihkan = Room::where('status', 'dibersihkan')->count();

        // Calculate occupancy rate
        $occupancyRate = $totalRooms > 0
            ? round(($terisi / $totalRooms) * 100, 1)
            : 0;

        $stats = [
            'total' => $totalRooms,
            'tersedia' => $tersedia,
            'terisi' => $terisi,
            'dibersihkan' => $dibersihkan,
            'occupancyRate' => $occupancyRate,
        ];

        // Chart data - last 7 days
        $chartLabels = [];
        $chartData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $chartLabels[] = $date->format('d M');
            $chartData[] = Audit::whereDate('created_at', $date)->count();
        }

        // Recent audits
        $recentAudits = Audit::with(['room', 'user'])
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        return view('admin.dashboard', compact('stats', 'chartLabels', 'chartData', 'recentAudits', 'occupancyRate'));
    }
}
