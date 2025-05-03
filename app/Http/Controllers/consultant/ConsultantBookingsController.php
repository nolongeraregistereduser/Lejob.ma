<?php

namespace App\Http\Controllers\Consultant;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Mail\ReservationApproved;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

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
     * Afficher le formulaire d'acceptation avec les notes
     */
    public function showAcceptForm(Reservation $reservation) 
    {
        // Check if the consultant owns this reservation
        if ($reservation->consultant_id !== Auth::id()) {
            return redirect()->route('consultant.bookings')
                ->with('error', 'Vous n\'êtes pas autorisé à effectuer cette action.');
        }
        
        return view('consultant.bookings.accept-form', compact('reservation'));
    }
    
    /**
     * Accepter une réservation avec des notes
     */
    public function accept(Request $request, Reservation $reservation)
    {
        // Check if the consultant owns this reservation
        if ($reservation->consultant_id !== Auth::id()) {
            return redirect()->route('consultant.bookings')
                ->with('error', 'Vous n\'êtes pas autorisé à effectuer cette action.');
        }
        
        // Validate the request
        $request->validate([
            'notes' => 'required|string|max:1000',
        ]);
        
        // Update reservation status and notes
        $reservation->status = 'confirmed';
        $reservation->notes = $request->notes;
        $reservation->save();
        
        // Send email to the user
        try {
            Mail::to($reservation->user->email)->send(new \App\Mail\ReservationApproved($reservation));
            Log::info("Reservation approval email sent to: " . $reservation->user->email);
        } catch (\Exception $e) {
            Log::error("Failed to send reservation approval email: " . $e->getMessage());
        }
        
        return redirect()->route('consultant.bookings')
            ->with('success', 'La réservation a été acceptée avec succès et le client a été notifié par email.');
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