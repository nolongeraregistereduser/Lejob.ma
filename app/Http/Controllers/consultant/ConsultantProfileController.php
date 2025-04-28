<?php

namespace App\Http\Controllers\Consultant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ConsultantProfileController extends Controller
{
    /**
     * Display the consultant profile page.
     */
    public function show()
    {
        $user = auth()->user();
        return view('consultant.profile', compact('user'));
    }

    /**
     * Update the consultant profile.
     */
    public function update(Request $request)
    {
        $user = auth()->user();
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
            'whatsapp' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'profile_picture' => 'nullable|image|max:2048',
            'hourly_rate' => 'nullable|numeric|min:0',
        ]);
        

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            // Delete old profile picture if exists
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }
            
            // Store new profile picture
            $path = $request->file('profile_picture')->store('profile-pictures', 'public');
            $validated['profile_picture'] = $path;
        }
        
        $user->hourly_rate = $request->hourly_rate;
        $user->update($validated);
        
        return redirect()->route('consultant.profile')->with('success', 'Profil mis à jour avec succès');
    }
}