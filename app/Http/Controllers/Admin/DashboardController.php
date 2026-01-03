<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_hotels' => Hotel::count(),
            'total_reservations' => Reservation::count(),
            'pending_reservations' => Reservation::where('status', 'pending')->count(),
            'total_users' => User::count(),
            'total_revenue' => Reservation::where('status', 'confirmed')->sum('total_price'),
        ];

        $recent_reservations = Reservation::with(['hotel', 'user'])
            ->latest()
            ->limit(10)
            ->get();

        $popular_hotels = Hotel::withCount('reservations')
            ->orderBy('reservations_count', 'desc')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recent_reservations', 'popular_hotels'));
    }
}
