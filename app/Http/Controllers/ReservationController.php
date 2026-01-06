<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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

        // Store booking data in session for payment page
        $bookingData = [
            'hotel_id' => $hotel->id,
            'check_in' => $validated['check_in'],
            'check_out' => $validated['check_out'],
            'guests' => $validated['guests'],
            'total_price' => $totalPrice,
            'nights' => $nights,
        ];

        session(['booking_data' => $bookingData]);

        return redirect()->route('payment.show', $hotel);
    }

    public function showPayment(Hotel $hotel)
    {
        $bookingData = session('booking_data');
        
        if (!$bookingData || $bookingData['hotel_id'] != $hotel->id) {
            return redirect()->route('hotels.show', $hotel)
                ->with('error', 'Please complete the booking form first.');
        }

        return view('payment.show', [
            'hotel' => $hotel,
            'booking' => $bookingData,
        ]);
    }

    public function processPayment(Request $request, Hotel $hotel)
    {
        $bookingData = session('booking_data');
        
        if (!$bookingData || $bookingData['hotel_id'] != $hotel->id) {
            return redirect()->route('hotels.show', $hotel)
                ->with('error', 'Booking session expired. Please try again.');
        }

        $request->validate([
            'payment_method' => ['required', 'string', 'in:card,cash'],
        ]);

        // For demo purposes, we'll simulate payment success
        // In production, integrate with Stripe/PayPal here
        $paymentStatus = 'paid';
        $paymentMethod = $request->payment_method;

        // Create reservation
        $reservation = Reservation::create([
            'user_id' => Auth::id(),
            'hotel_id' => $hotel->id,
            'check_in' => $bookingData['check_in'],
            'check_out' => $bookingData['check_out'],
            'guests' => $bookingData['guests'],
            'total_price' => $bookingData['total_price'],
            'status' => 'confirmed',
            'payment_status' => $paymentStatus,
            'payment_method' => $paymentMethod,
            'paid_at' => now(),
        ]);

        // Clear booking session
        session()->forget('booking_data');

        return redirect()->route('reservations.index')
            ->with('success', 'Reservation confirmed and payment processed successfully!');
    }
}
