<?php

namespace App\Http\Controllers\Consultant;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::where('consultant_id', Auth::id())
            ->orderBy('date', 'desc')
            ->orderBy('time', 'desc')
            ->paginate(10);
            
        return view('consultant.bookings.index', compact('reservations'));
    }
    
    public function confirm(Reservation $reservation)
    {
        if ($reservation->consultant_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        $reservation->updateStatus('CONFIRMED');
        
        // Here you could add notification logic to inform the user
        
        return redirect()->route('consultant.bookings')
            ->with('success', 'Booking confirmed successfully.');
    }
    
    public function cancel(Reservation $reservation)
    {
        if ($reservation->consultant_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        $reservation->updateStatus('CANCELLED');
        
        // Here you could add notification logic to inform the user
        
        return redirect()->route('consultant.bookings')
            ->with('success', 'Booking cancelled successfully.');
    }
}