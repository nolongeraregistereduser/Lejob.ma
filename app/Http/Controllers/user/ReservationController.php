<?php

namespace App\Http\Controllers\user;

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
     * Display a listing of the user's reservations.
     */
    public function index()
    {
        $reservations = Auth::user()->reservationsAsUser()
            ->with('consultant')
            ->orderBy('date', 'desc')
            ->get();
        
        return view('user.reservations.index', compact('reservations'));
    }

    /**
     * Show the form for creating a new reservation.
     */
    public function create()
    {
        $consultants = User::where('role', 'consultant')
            ->with(['reservationsAsConsultant' => function($query) {
                $query->where('status', '!=', 'cancelled');
            }])
            ->get();
        
        return view('user.reservations.create', compact('consultants'));
    }

    /**
     * Store a newly created reservation in database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'consultant_id' => 'required|exists:users,id',
            'date' => 'required|date|after_or_equal:today',
            'time_slot' => 'required|in:09:00,10:00,11:00,13:00,14:00,15:00,16:00',
        ]);

        // Check for time slot conflicts
        $conflictExists = Reservation::where('consultant_id', $validated['consultant_id'])
            ->where('date', $validated['date'])
            ->where('time_slot', $validated['time_slot'])
            ->where('status', '!=', 'cancelled')
            ->exists();

        if ($conflictExists) {
            return back()->with('error', 'This time slot is already booked. Please choose another one.');
        }

        // Create the reservation
        $reservation = new Reservation([
            'user_id' => Auth::id(),
            'consultant_id' => $validated['consultant_id'],
            'date' => $validated['date'],
            'time_slot' => $validated['time_slot'],
            'status' => 'pending',
        ]);

        $reservation->save();

        return redirect()->route('user.reservations.index')
            ->with('success', 'Reservation submitted successfully!');
    }
}