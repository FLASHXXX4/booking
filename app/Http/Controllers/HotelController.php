<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function index(Request $request)
    {
        $query = Hotel::query();

        // Search by name
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Filter by city
        if ($request->filled('city')) {
            $query->where('city', $request->city);
        }

        $hotels = $query->paginate(12);
        $cities = Hotel::distinct()->pluck('city')->sort()->values();

        return view('hotels.index', compact('hotels', 'cities'));
    }

    public function show(Hotel $hotel)
    {
        return view('hotels.show', compact('hotel'));
    }
}
