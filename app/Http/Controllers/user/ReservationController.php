<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Afficher la liste des réservations de l'utilisateur
     */
    public function index()
    {
        $reservations = Reservation::with(['consultant', 'feedback'])
            ->where('user_id', Auth::id())
            ->orderBy('date', 'desc')
            ->orderBy('time_slot', 'desc')
            ->get();
            
        return view('user.reservations.index', compact('reservations'));
    }

    /**
     * Afficher le formulaire de création d'une réservation
     */
    public function create(Request $request)
    {
        $consultants = User::where('role', 'consultant')
            ->where('status', 'active')
            ->orderBy('name')
            ->get();
            
        $selectedConsultantId = $request->input('consultant_id');
            
        return view('user.reservations.create', compact('consultants', 'selectedConsultantId'));
    }

    /**
     * Enregistrer une nouvelle réservation
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'consultant_id' => 'required|exists:users,id',
            'date' => 'required|date|after_or_equal:today',
            'time_slot' => 'required',
            'notes' => 'nullable|string|max:500',
        ]);
        
        $reservation = new Reservation([
            'user_id' => Auth::id(),
            'consultant_id' => $validated['consultant_id'],
            'date' => $validated['date'],
            'time_slot' => $validated['time_slot'],
            'status' => 'pending',
            'notes' => $validated['notes'] ?? null,
        ]);
        
        $reservation->save();
        
        return redirect()->route('user.reservations.index')
            ->with('success', 'Votre demande de réservation a été envoyée avec succès.');
    }
}