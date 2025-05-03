<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Feedback;
use Illuminate\Http\Request;

class ConsultantController extends Controller
{

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
    
    public function show($id)
    {
        $consultant = User::where('role', 'consultant')
            ->where('status', 'active')
            ->findOrFail($id);
        
        // Get feedback for this consultant
        $feedbacks = Feedback::where('consultant_id', $consultant->id)
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->get();
        
        // Calculate average rating
        $averageRating = $feedbacks->count() > 0 ? $feedbacks->avg('rating') : 0;
        
        return view('consultants.show', compact('consultant', 'feedbacks', 'averageRating'));
    }
}

