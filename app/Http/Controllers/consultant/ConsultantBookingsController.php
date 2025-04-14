<?php

namespace App\Http\Controllers\Consultant;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConsultantBookingsController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
        // $this->middleware('role:consultant');
    }

    /**
     * Afficher les réservations du consultant
     */
    public function index()
    {
        $pendingReservations = Reservation::with('user')
            ->where('consultant_id', Auth::id())
            ->where('status', 'pending')
            ->orderBy('date', 'asc')
            ->get();
            
        $confirmedReservations = Reservation::with('user')
            ->where('consultant_id', Auth::id())
            ->where('status', 'confirmed')
            ->orderBy('date', 'asc')
            ->get();
            
        $completedReservations = Reservation::with(['user', 'feedback'])
            ->where('consultant_id', Auth::id())
            ->where('status', 'completed')
            ->orderBy('date', 'desc')
            ->get();
            
        $cancelledReservations = Reservation::with('user')
            ->where('consultant_id', Auth::id())
            ->where('status', 'cancelled')
            ->orderBy('date', 'desc')
            ->get();
            
        $pendingCount = $pendingReservations->count();
        
        return view('consultant.bookings', compact(
            'pendingReservations', 
            'confirmedReservations', 
            'completedReservations', 
            'cancelledReservations',
            'pendingCount'
        ));
    }
    
    /**
     * Accepter une réservation
     */
    public function accept(Reservation $reservation)
    {
        if ($reservation->consultant_id !== Auth::id()) {
            return redirect()->route('consultant.bookings')
                ->with('error', 'Vous n\'êtes pas autorisé à effectuer cette action.');
        }
        
        $reservation->status = 'confirmed';
        $reservation->save();
        
        return redirect()->route('consultant.bookings')
            ->with('success', 'La réservation a été acceptée avec succès.');
    }
    
    /**
     * Rejeter une réservation
     */
    public function reject(Reservation $reservation)
    {
        if ($reservation->consultant_id !== Auth::id()) {
            return redirect()->route('consultant.bookings')
                ->with('error', 'Vous n\'êtes pas autorisé à effectuer cette action.');
        }
        
        $reservation->status = 'cancelled';
        $reservation->save();
        
        return redirect()->route('consultant.bookings')
            ->with('success', 'La réservation a été rejetée.');
    }
    
    /**
     * Marquer une réservation comme terminée
     */
    public function complete(Reservation $reservation)
    {
        if ($reservation->consultant_id !== Auth::id()) {
            return redirect()->route('consultant.bookings')
                ->with('error', 'Vous n\'êtes pas autorisé à effectuer cette action.');
        }
        
        $reservation->status = 'completed';
        $reservation->save();
        
        return redirect()->route('consultant.bookings')
            ->with('success', 'La réservation a été marquée comme terminée.');
    }
}