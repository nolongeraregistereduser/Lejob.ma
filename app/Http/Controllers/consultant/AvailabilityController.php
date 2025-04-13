<?php

namespace App\Http\Controllers\Consultant;

use App\Http\Controllers\Controller;
use App\Models\Availability;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AvailabilityController extends Controller
{
    public function index()
    {
        $availabilities = Availability::where('consultant_id', Auth::id())
            ->orderBy('day_of_week')
            ->orderBy('start_time')
            ->get();
            
        return view('consultant.availability.index', compact('availabilities'));
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'day_of_week' => 'required|integer|min:0|max:6',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'is_available' => 'boolean',
        ]);
        
        $availability = new Availability();
        $availability->consultant_id = Auth::id();
        $availability->day_of_week = $validated['day_of_week'];
        $availability->start_time = $validated['start_time'];
        $availability->end_time = $validated['end_time'];
        $availability->is_available = $validated['is_available'] ?? true;
        $availability->save();
        
        return redirect()->route('consultant.availability')
            ->with('success', 'Availability slot added successfully.');
    }
    
    public function update(Request $request, Availability $availability)
    {
        if ($availability->consultant_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        $validated = $request->validate([
            'day_of_week' => 'required|integer|min:0|max:6',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'is_available' => 'boolean',
        ]);
        
        $availability->day_of_week = $validated['day_of_week'];
        $availability->start_time = $validated['start_time'];
        $availability->end_time = $validated['end_time'];
        $availability->is_available = $validated['is_available'] ?? true;
        $availability->save();
        
        return redirect()->route('consultant.availability')
            ->with('success', 'Availability slot updated successfully.');
    }
    
    public function destroy(Availability $availability)
    {
        if ($availability->consultant_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        $availability->delete();
        
        return redirect()->route('consultant.availability')
            ->with('success', 'Availability slot removed successfully.');
    }
}