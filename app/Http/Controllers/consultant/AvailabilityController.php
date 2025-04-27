<?php

namespace App\Http\Controllers\Consultant;

use App\Http\Controllers\Controller;
use App\Models\ConsultantAvailability;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AvailabilityController extends Controller
{
    public function index()
    {
        $consultant = Auth::user();
        $availabilities = $consultant->availabilities()
            ->orderBy('date')
            ->orderBy('start_time')
            ->get();
        
        return view('consultant.availability.index', compact('availabilities'));
    }
    
    public function create()
    {
        return view('consultant.availability.create');
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date|after_or_equal:today',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);
        
        ConsultantAvailability::create([
            'consultant_id' => Auth::id(),
            'date' => $validated['date'],
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
            'is_booked' => false,
        ]);
        
        return redirect()->route('consultant.availability.index')
            ->with('success', 'Plage horaire ajoutée avec succès');
    }
    
    public function destroy(ConsultantAvailability $availability)
    {
        // Check if the consultant owns this availability
        if ($availability->consultant_id !== Auth::id()) {
            return redirect()->route('consultant.availability.index')
                ->with('error', 'Vous n\'êtes pas autorisé à supprimer cette disponibilité');
        }
        
        // Check if the availability is already booked
        if ($availability->is_booked) {
            return redirect()->route('consultant.availability.index')
                ->with('error', 'Impossible de supprimer une plage horaire déjà réservée');
        }
        
        $availability->delete();
        
        return redirect()->route('consultant.availability.index')
            ->with('success', 'Plage horaire supprimée avec succès');
    }
}