<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationManagementController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with(['hotel', 'user'])
            ->latest()
            ->paginate(15);

        return view('admin.reservations.index', compact('reservations'));
    }

    public function updateStatus(Request $request, Reservation $reservation)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled',
        ]);

        $reservation->update(['status' => $validated['status']]);

        return redirect()->route('admin.reservations.index')
            ->with('success', 'Reservation status updated successfully!');
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();

        return redirect()->route('admin.reservations.index')
            ->with('success', 'Reservation deleted successfully!');
    }
}
