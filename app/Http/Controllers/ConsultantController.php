<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ConsultantController extends Controller
{
    /**
     * Display a listing of consultants.
     */
    public function index()
    {
        // Get all users with the consultant role
        $consultants = User::where('role', 'consultant')
            ->where('status', 'active')
            ->where('available_for_hire', true)
            ->with('feedback') // Eager load feedback for ratings
            ->get();
            
        return view('consultants.index', compact('consultants'));
    }

    /**
     * Display the specified consultant.
     */
    public function show($id)
    {
        $consultant = User::where('role', 'consultant')
            ->where('status', 'active')
            ->where('id', $id)
            ->with(['feedback', 'availabilities'])
            ->firstOrFail();
            
        return view('consultants.show', compact('consultant'));
    }
}