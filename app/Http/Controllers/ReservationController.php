<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Auth::user()->reservations()->with('hotel')->latest()->get();
        return view('reservations.index', compact('reservations'));
    }

    public function store(Request $request, Hotel $hotel)
    {
        $validated = $request->validate([
            'check_in' => ['required', 'date', 'after_or_equal:today'],
            'check_out' => ['required', 'date', 'after:check_in'],
            'guests' => ['required', 'integer', 'min:1', 'max:10'],
        ]);

        $checkIn = \Carbon\Carbon::parse($validated['check_in']);
        $checkOut = \Carbon\Carbon::parse($validated['check_out']);
        $nights = $checkIn->diffInDays($checkOut);
        $totalPrice = $nights * $hotel->price_per_night;

        Reservation::create([
            'user_id' => Auth::id(),
            'hotel_id' => $hotel->id,
            'check_in' => $validated['check_in'],
            'check_out' => $validated['check_out'],
            'guests' => $validated['guests'],
            'total_price' => $totalPrice,
            'status' => 'pending',
        ]);

        return redirect()->route('reservations.index')
            ->with('success', 'Reservation created successfully!');
    }
}
