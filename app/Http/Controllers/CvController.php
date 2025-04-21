<?php

namespace App\Http\Controllers;

use App\Models\Cv;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CvController extends Controller
{
  
    public function index()
    {
        $user = Auth::user();
        $cvs = $user->cvs;
        
        return view('cv.index', compact('cvs'));
    }

   
    public function create()
    {
        return view('cv.create');
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'titre' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            'education' => 'required|string',
            'experience' => 'required|string',
            'skills' => 'required|string',
            'certifications' => 'nullable|string',
            'languages' => 'nullable|string',
            'projects' => 'nullable|string',
            'cv_file' => 'nullable|file|mimes:pdf|max:5120', // Optional PDF file (max 5MB)
        ]);

        $cvFilePath = null;
        if ($request->hasFile('cv_file')) {
            $file = $request->file('cv_file');
            $cvFilePath = $file->store('cv_files', 'public');
        }

        $cv = new Cv($request->all());
        $cv->user_id = Auth::id();
        
        if ($cvFilePath) {
            $cv->cv_file = $cvFilePath;
        }
        
        $cv->save();

        return response()->json([
            'success' => true,
            'message' => 'CV created successfully!',
            'cv' => $cv
        ]);
    }

 
    public function show(Cv $cv)
    {
        // Make sure the user owns this CV
        if ($cv->user_id !== Auth::id()) {
            return abort(403, 'Unauthorized action.');
        }
        
        return view('cv.show', compact('cv'));
    }

 
    public function edit(Cv $cv)
    {
        // Make sure the user owns this CV
        if ($cv->user_id !== Auth::id()) {
            return abort(403, 'Unauthorized action.');
        }
        
        return view('cv.edit', compact('cv'));
    }

    
    public function update(Request $request, Cv $cv)
    {
        // Make sure the user owns this CV
        if ($cv->user_id !== Auth::id()) {
            return abort(403, 'Unauthorized action.');
        }
        
        $request->validate([
            'name' => 'required|string|max:255',
            'titre' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            'education' => 'required|string',
            'experience' => 'required|string',
            'skills' => 'required|string',
            'certifications' => 'nullable|string',
            'languages' => 'nullable|string',
            'projects' => 'nullable|string',
            'cv_file' => 'nullable|file|mimes:pdf|max:5120', // Optional PDF file (max 5MB)
        ]);

        if ($request->hasFile('cv_file')) {
            // Delete old file if exists
            if ($cv->cv_file) {
                Storage::disk('public')->delete($cv->cv_file);
            }
            
            $file = $request->file('cv_file');
            $cv->cv_file = $file->store('cv_files', 'public');
        }

        $cv->update($request->except('cv_file'));

        return response()->json([
            'success' => true,
            'message' => 'CV updated successfully!',
            'cv' => $cv
        ]);
    }

    public function destroy(Cv $cv)
    {
        // Make sure the user owns this CV
        if ($cv->user_id !== Auth::id()) {
            return abort(403, 'Unauthorized action.');
        }
        
        // Delete the file if exists
        if ($cv->cv_file) {
            Storage::disk('public')->delete($cv->cv_file);
        }
        
        $cv->delete();

        return response()->json([
            'success' => true,
            'message' => 'CV deleted successfully!'
        ]);
    }

   
    public function getCurrentCv()
    {
        $user = Auth::user();
        $cv = $user->cvs()->latest()->first();
        
        if (!$cv) {
            return response()->json(null);
        }
        
        return response()->json($cv);
    }
}
