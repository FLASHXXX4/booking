<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelManagementController extends Controller
{
    public function index()
    {
        $hotels = Hotel::latest()->paginate(15);
        return view('admin.hotels.index', compact('hotels'));
    }

    public function create()
    {
        return view('admin.hotels.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'description' => 'required|string',
            'address' => 'required|string|max:255',
            'price_per_night' => 'required|numeric|min:0',
            'rating' => 'nullable|numeric|min:0|max:5',
            'image' => 'nullable|string|max:255',
            'amenities' => 'nullable|array',
        ]);

        Hotel::create($validated);

        return redirect()->route('admin.hotels.index')
            ->with('success', 'Hotel created successfully!');
    }

    public function edit(Hotel $hotel)
    {
        return view('admin.hotels.edit', compact('hotel'));
    }

    public function update(Request $request, Hotel $hotel)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'description' => 'required|string',
            'address' => 'required|string|max:255',
            'price_per_night' => 'required|numeric|min:0',
            'rating' => 'nullable|numeric|min:0|max:5',
            'image' => 'nullable|string|max:255',
            'amenities' => 'nullable|array',
        ]);

        $hotel->update($validated);

        return redirect()->route('admin.hotels.index')
            ->with('success', 'Hotel updated successfully!');
    }

    public function destroy(Hotel $hotel)
    {
        $hotel->delete();

        return redirect()->route('admin.hotels.index')
            ->with('success', 'Hotel deleted successfully!');
    }
}
