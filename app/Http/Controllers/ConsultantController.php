<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Feedback;
use Illuminate\Http\Request;

class ConsultantController extends Controller
{
    /**
     * Affiche la liste des consultants avec leur feedback.
     */
    public function index(Request $request)
    {
        $query = User::where('role', 'consultant');

        // Filtre par recherche
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('speciality', 'like', "%{$search}%");
            });
        }

        // Filtre par spécialité
        if ($request->has('specialty') && !empty($request->specialty)) {
            $query->where('speciality', $request->specialty);
        }

        // Récupérer les consultants avec leurs feedbacks
        $consultants = $query->with(['feedbacks' => function($query) {
                            $query->latest()->limit(3);
                        }])
                        ->paginate(9);

        return view('consultants.index', compact('consultants'));
    }
}

namespace App\Http\Controllers\Consultant;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConsultantBookingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:consultant');
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
            
        $completedReservations = Reservation::with('user')
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
        // Vérifier que la réservation appartient bien à ce consultant
        if ($reservation->consultant_id !== Auth::id()) {
            return redirect()->route('consultant.bookings')
                ->with('error', 'Vous n\'êtes pas autorisé à effectuer cette action.');
        }
        
        $reservation->status = 'confirmed';
        $reservation->save();
        
        // Ici vous pourriez ajouter un code pour envoyer une notification à l'utilisateur
        
        return redirect()->route('consultant.bookings')
            ->with('success', 'La réservation a été acceptée avec succès.');
    }
    
    /**
     * Rejeter une réservation
     */
    public function reject(Reservation $reservation)
    {
        // Vérifier que la réservation appartient bien à ce consultant
        if ($reservation->consultant_id !== Auth::id()) {
            return redirect()->route('consultant.bookings')
                ->with('error', 'Vous n\'êtes pas autorisé à effectuer cette action.');
        }
        
        $reservation->status = 'cancelled';
        $reservation->save();
        
        // Ici vous pourriez ajouter un code pour envoyer une notification à l'utilisateur
        
        return redirect()->route('consultant.bookings')
            ->with('success', 'La réservation a été rejetée.');
    }
    
    /**
     * Marquer une réservation comme terminée
     */
    public function complete(Reservation $reservation)
    {
        // Vérifier que la réservation appartient bien à ce consultant
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