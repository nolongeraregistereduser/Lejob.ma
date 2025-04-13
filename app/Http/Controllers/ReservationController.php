<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\User;
use App\Models\Availability;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::where('user_id', Auth::id())
            ->orderBy('date', 'desc')
            ->orderBy('time', 'desc')
            ->paginate(10);
            
        return view('reservations.index', compact('reservations'));
    }
    
    public function create($consultant_id)
    {
        $consultant = User::findOrFail($consultant_id);
        $availabilities = Availability::where('consultant_id', $consultant_id)
            ->where('is_available', true)
            ->get();
            
        return view('reservations.create', compact('consultant', 'availabilities'));
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'consultant_id' => 'required|exists:users,id',
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required',
            'duration' => 'required|integer|min:30|max:180',
            'notes' => 'nullable|string|max:500',
        ]);
        
        $reservation = new Reservation();
        $reservation->user_id = Auth::id();
        $reservation->consultant_id = $validated['consultant_id'];
        $reservation->date = $validated['date'];
        $reservation->time = $validated['time'];
        $reservation->duration = $validated['duration'];
        $reservation->notes = $validated['notes'] ?? null;
        $reservation->status = 'PENDING';
        $reservation->save();
        
        return redirect()->route('reservations.show', $reservation->id)
            ->with('success', 'Reservation created successfully. Waiting for consultant confirmation.');
    }
    
    public function show(Reservation $reservation)
    {
        if ($reservation->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        return view('reservations.show', compact('reservation'));
    }
    
    public function cancel(Reservation $reservation)
    {
        if ($reservation->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        $reservation->cancel();
        
        return redirect()->route('reservations.index')
            ->with('success', 'Reservation cancelled successfully.');
    }
}