<?php

namespace App\Http\Controllers\Consultant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ConsultantProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('consultant.profile', compact('user'));
    }


    public function update(Request $request)
    {
        $user = Auth::user();
        
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'whatsapp' => 'nullable|string|max:20',
            'city' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'bio' => 'nullable|string',
            'hourly_rate' => 'nullable|numeric|min:0',
            'profile_picture' => 'nullable|image|max:2048',
        ]);

        // Update user information
        $user->name = $request->name;
        $user->title = $request->title;
        $user->phone = $request->phone;
        $user->whatsapp = $request->whatsapp;
        $user->city = $request->city;
        $user->country = $request->country;
        $user->bio = $request->bio;
        $user->hourly_rate = $request->hourly_rate;

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            // Delete old image if exists
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }
            
            // Store new image
            $path = $request->file('profile_picture')->store('profile_images', 'public');
            $user->profile_picture = $path;
        }

        $user->save();

        return redirect()->route('consultant.profile')->with('success', 'Profil mis à jour avec succès!');
    }
}