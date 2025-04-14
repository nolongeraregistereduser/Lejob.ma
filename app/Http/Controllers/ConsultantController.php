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

