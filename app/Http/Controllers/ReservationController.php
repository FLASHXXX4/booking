<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

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

        // Use direct URL to avoid route cache issues
        return redirect("/hotels/{$hotel->id}/payment");
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

        $rules = [
            'payment_method' => ['required', 'string', 'in:card,cash'],
        ];

        // Add card validation if payment method is card
        if ($request->payment_method === 'card') {
            $rules['card_number'] = ['required', 'string', 'regex:/^[0-9\s]{13,19}$/'];
            $rules['card_name'] = ['required', 'string', 'max:255'];
            $rules['card_expiry'] = ['required', 'string', 'regex:/^(0[1-9]|1[0-2])\/\d{2}$/'];
            $rules['card_cvv'] = ['required', 'string', 'regex:/^\d{3,4}$/'];
        }

        $request->validate($rules);

        // For demo purposes, we'll simulate payment success
        // In production, integrate with Stripe/PayPal here
        $paymentStatus = 'paid';
        $paymentMethod = $request->payment_method;

        // Create reservation
        $reservationData = [
            'user_id' => Auth::id(),
            'hotel_id' => $hotel->id,
            'check_in' => $bookingData['check_in'],
            'check_out' => $bookingData['check_out'],
            'guests' => $bookingData['guests'],
            'total_price' => $bookingData['total_price'],
            'status' => 'confirmed',
        ];

        // Add payment fields if columns exist (migration has been run)
        $schema = Schema::getColumnListing('reservations');
        if (in_array('payment_status', $schema)) {
            $reservationData['payment_status'] = $paymentStatus;
            $reservationData['payment_method'] = $paymentMethod;
            $reservationData['paid_at'] = now();
        }

        $reservation = Reservation::create($reservationData);

        // Clear booking session
        session()->forget('booking_data');

        return redirect()->route('reservations.index')
            ->with('success', 'Reservation confirmed and payment processed successfully!');
    }
}
