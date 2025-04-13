<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    /**
     * Affiche le profil de l'utilisateur
     */
    public function show()
    {
        $user = Auth::user();
        return view('user.profile', compact('user'));
    }

    /**
     * Met à jour le profil de l'utilisateur
     */
    public function update(Request $request)
    {
        try {
            $user = Auth::user();
            
            $validated = $request->validate([
                'first_name' => 'nullable|string|max:255',
                'last_name' => 'nullable|string|max:255',
                'username' => 'nullable|string|max:255|unique:users,username,'.$user->id,
                'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
                'phone' => 'nullable|string|max:20',
                'whatsapp' => 'nullable|string|max:20',
                'address' => 'nullable|string|max:255',
                'city' => 'nullable|string|max:100',
                'country' => 'nullable|string|max:100',
                'bio' => 'nullable|string',
                'title' => 'nullable|string|max:255',
                'password' => 'nullable|string|min:8|confirmed',
                'profile_picture' => 'nullable|image|max:2048',
                'title' => 'nullable|string|max:255',
                'portfolio' => 'nullable|string',
                'linkedin' => 'nullable|string|max:255',
                'github' => 'nullable|string|max:255',
                'twitter' => 'nullable|string|max:255',
                'website' => 'nullable|string|max:255',
            ]);
            
            // Débogage
            Log::info('Données de formulaire reçues', $request->all());
            
            // Mise à jour du nom complet à partir du prénom et du nom
            if ($request->filled('first_name') || $request->filled('last_name')) {
                $name = trim(($request->first_name ?? '') . ' ' . ($request->last_name ?? ''));
                if (!empty($name)) {
                    $user->name = $name;
                }
            }
            
            // Gestion de l'upload de la photo de profil
            if ($request->hasFile('profile_picture')) {
                // Suppression de l'ancienne photo si elle existe
                if ($user->profile_picture) {
                    Storage::disk('public')->delete($user->profile_picture);
                }
                
                // Stockage de la nouvelle photo
                $path = $request->file('profile_picture')->store('profile-pictures', 'public');
                $user->profile_picture = $path;
            }
            
            // Gestion du mot de passe
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }
            
            // Gestion de "disponible pour embauche"
            $user->available_for_hire = $request->has('available_for_hire');
            
            // Mise à jour des champs du profil
            $user->email = $request->email;
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->username = $request->username;
            $user->phone = $request->phone;
            $user->whatsapp = $request->whatsapp;
            $user->address = $request->address;
            $user->city = $request->city;
            $user->country = $request->country;
            $user->bio = $request->bio;
            $user->title = $request->title;
            
            // Mise à jour des liens sociaux
            $user->portfolio = $request->portfolio;
            $user->linkedin = $request->linkedin;
            $user->github = $request->github;
            $user->twitter = $request->twitter;
            $user->website = $request->website;
            
            $user->save();
            
            // Use flash instead of with to ensure the message only persists for one request
            session()->flash('success', 'Profil mis à jour avec succès!');
            return redirect()->route('profile');
        } catch (\Exception $e) {
            Log::error('Erreur lors de la mise à jour du profil: ' . $e->getMessage());
            return redirect()->route('profile')->with('error', 'Une erreur s\'est produite lors de la mise à jour du profil: ' . $e->getMessage());
        }
    }
}
