<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'reservation_id' => 'required|exists:reservations,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
            'is_public' => 'boolean',
        ]);
        
        // Check if the reservation belongs to the user
        $reservation = Reservation::findOrFail($validated['reservation_id']);
        if ($reservation->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        // Check if feedback already exists
        $existingFeedback = Feedback::where('reservation_id', $validated['reservation_id'])->first();
        if ($existingFeedback) {
            return redirect()->back()->with('error', 'You have already provided feedback for this reservation.');
        }
        
        $feedback = new Feedback();
        $feedback->reservation_id = $validated['reservation_id'];
        $feedback->user_id = Auth::id();
        $feedback->rating = $validated['rating'];
        $feedback->comment = $validated['comment'] ?? null;
        $feedback->is_public = $validated['is_public'] ?? false;
        $feedback->save();
        
        return redirect()->back()->with('success', 'Thank you for your feedback!');
    }
    
    public function update(Request $request, Feedback $feedback)
    {
        if ($feedback->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
            'is_public' => 'boolean',
        ]);
        
        $feedback->rating = $validated['rating'];
        $feedback->comment = $validated['comment'] ?? null;
        $feedback->is_public = $validated['is_public'] ?? false;
        $feedback->save();
        
        return redirect()->back()->with('success', 'Feedback updated successfully.');
    }
}