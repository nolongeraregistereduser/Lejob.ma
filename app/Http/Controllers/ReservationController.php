<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Consultant;
use App\Models\Availability;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ReservationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the user's reservations.
     */
    public function index()
    {
        $reservations = Auth::user()->reservations()->with('consultant')->latest()->get();
        
        return view('reservations.index', compact('reservations'));
    }

    /**
     * Show the form for creating a new reservation.
     */
    public function create(Consultant $consultant)
    {
        $availabilities = $consultant->availabilities()->where('is_available', true)->get();
        
        return view('reservations.create', compact('consultant', 'availabilities'));
    }

    /**
     * Store a newly created reservation in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'consultant_id' => 'required|exists:consultants,id',
            'date' => 'required|date|after_or_equal:today',
            'availability_id' => 'required|exists:availabilities,id',
            'topic' => 'required|string|max:255',
            'notes' => 'nullable|string',
        ]);

        // Get the selected availability
        $availability = Availability::findOrFail($request->availability_id);
        
        // Check if the consultant is available on the selected date and time
        $dayOfWeek = Carbon::parse($request->date)->dayOfWeek;
        if ($dayOfWeek != $availability->day_of_week || !$availability->is_available) {
            return back()->with('error', 'Le consultant n\'est pas disponible à cette date et heure.');
        }
        
        // Check if there's already a reservation for this time slot
        $existingReservation = Reservation::where('consultant_id', $request->consultant_id)
            ->where('date', $request->date)
            ->where('start_time', $availability->start_time)
            ->where('status', '!=', 'cancelled')
            ->exists();
            
        if ($existingReservation) {
            return back()->with('error', 'Ce créneau horaire est déjà réservé. Veuillez en choisir un autre.');
        }

        // Create the reservation
        $reservation = new Reservation();
        $reservation->user_id = Auth::id();
        $reservation->consultant_id = $request->consultant_id;
        $reservation->date = $request->date;
        $reservation->start_time = $availability->start_time;
        $reservation->end_time = $availability->end_time;
        $reservation->topic = $request->topic;
        $reservation->notes = $request->notes;
        $reservation->status = 'pending';
        $reservation->save();

        // TODO: Send notification emails

        return redirect()->route('reservations.show', $reservation->id)
            ->with('success', 'Votre réservation a été créée avec succès et est en attente de confirmation.');
    }

    /**
     * Display the specified reservation.
     */
    public function show(Reservation $reservation)
    {
        // Check if the reservation belongs to the authenticated user
        if ($reservation->user_id !== Auth::id() && Auth::user()->role !== 'admin' && Auth::id() !== $reservation->consultant->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $reservation->load('consultant', 'feedback');
        
        return view('reservations.show', compact('reservation'));
    }

    /**
     * Cancel the specified reservation.
     */
    public function cancel(Reservation $reservation)
    {
        // Check if the reservation belongs to the authenticated user
        if ($reservation->user_id !== Auth::id() && Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        // Check if the reservation can be cancelled
        if (!in_array($reservation->status, ['pending', 'confirmed'])) {
            return back()->with('error', 'Cette réservation ne peut pas être annulée.');
        }

        $reservation->status = 'cancelled';
        $reservation->save();

        // TODO: Send cancellation notification

        return redirect()->route('reservations.index')
            ->with('success', 'Votre réservation a été annulée avec succès.');
    }
}