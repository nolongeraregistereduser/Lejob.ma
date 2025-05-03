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
        // Validate the request data
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
        
        $user = auth()->user();
        
        if ($request->hasFile('profile_picture')) {
            // Delete old image if exists
            if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
                Storage::disk('public')->delete($user->profile_picture);
            }
            
            // Store new image
            $path = $request->file('profile_picture')->store('profile-pictures', 'public');
            
            // Update database with relative path
            $user->profile_picture = $path;
        }
        
        // Update other fields
        $user->fill($validated);
        $user->save();
        
        return back()->with('success', 'Profile updated successfully');
    }
}