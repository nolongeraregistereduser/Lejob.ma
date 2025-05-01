<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use App\Models\User;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index(Request $request)
    {
        $query = Feedback::with(['user', 'consultant', 'reservation']);
        
        // Filter by rating
        if ($request->filled('rating')) {
            $query->where('rating', $request->rating);
        }
        
        // Filter by consultant
        if ($request->filled('consultant')) {
            $query->where('consultant_id', $request->consultant);
        }
        
        // Search by user or consultant name or comment content
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('user', function($q1) use ($search) {
                    $q1->where('name', 'like', "%{$search}%");
                })->orWhereHas('consultant', function($q2) use ($search) {
                    $q2->where('name', 'like', "%{$search}%");
                })->orWhere('comment', 'like', "%{$search}%");
            });
        }
        
        $feedbacks = $query->orderBy('created_at', 'desc')->paginate(15);
        $consultants = User::where('role', 'consultant')
                          ->where('status', 'active')
                          ->orderBy('name')
                          ->get();
        
        // Feedback statistics
        $stats = [
            'total' => Feedback::count(),
            'avg_rating' => number_format(Feedback::avg('rating'), 1),
            'five_stars' => Feedback::where('rating', 5)->count(),
            'one_star' => Feedback::where('rating', 1)->count(),
        ];
        
        return view('admin.feedback.index', compact('feedbacks', 'consultants', 'stats'));
    }
    
    public function show($id)
    {
        $feedback = Feedback::with(['user', 'consultant', 'reservation'])->findOrFail($id);
        return view('admin.feedback.show', compact('feedback'));
    }
    
    public function destroy($id)
    {
        $feedback = Feedback::findOrFail($id);
        $feedback->delete();
        
        return redirect()->route('admin.feedback.index')
            ->with('success', 'Feedback supprimé avec succès');
    }
}