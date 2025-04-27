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
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        
        // Get the user's most recent CV
        $cv = $user->cvs()->latest()->first();
        
        if (!$cv) {
            return response()->json(null); // Return null if no CV exists
        }
        
        // Return the CV data
        return response()->json([
            'name' => $cv->name,
            'titre' => $cv->titre,
            'email' => $cv->email,
            'phone' => $cv->phone,
            'education' => $cv->education,
            'experience' => $cv->experience,
            'skills' => $cv->skills,
            'certifications' => $cv->certifications,
            'languages' => $cv->languages,
            'projects' => $cv->projects
        ]);
    }

    /**
     * Upload PDF CV and save CV data
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadPdf(Request $request)
    {
        try {
            // Validate request
            $request->validate([
                'cv_file' => 'required|file|mimes:pdf|max:5120', // 5MB limit
                'name' => 'required',
                'titre' => 'required',
                'email' => 'required|email',
                // Keep the other validations
            ]);
            
            $user = Auth::user();
            
            // Check if user is authenticated
            if (!$user) {
                return response()->json(['error' => 'User not authenticated'], 401);
            }
            
            // Store the file
            $file = $request->file('cv_file');
            $timestamp = time();
            $filename = "cv_{$user->id}_{$timestamp}.pdf";
            
            // Make sure the directory exists
            Storage::makeDirectory('public/cvs');
            
            // Store in the storage/app/public/cvs directory
            $path = $file->storeAs('public/cvs', $filename);
            $publicPath = Storage::url($path); // Gets the public URL path
            
            // Create new CV record
            $cv = new Cv();
            $cv->user_id = $user->id;
            $cv->name = $request->name;
            $cv->titre = $request->titre;
            $cv->email = $request->email;
            $cv->phone = $request->phone;
            $cv->education = $request->education;
            $cv->experience = $request->experience;
            $cv->skills = $request->skills;
            $cv->certifications = $request->certifications ?? '';
            $cv->languages = $request->languages ?? '';
            $cv->projects = $request->projects ?? '';
            $cv->cv_file = $publicPath;
            
            $cv->save();
            
            return response()->json([
                'success' => true,
                'message' => 'CV saved successfully',
                'cv_url' => $publicPath,
                'cv' => $cv
            ]);
        } catch (\Exception $e) {
            
            return response()->json([
                'success' => false,
                'message' => 'Error saving CV: ' . $e->getMessage()
            ], 500);
        }
    }
}
