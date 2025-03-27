<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('register');
    }

    public function showLogin()
    {
        return view('login');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = $request->role;
        
        if($request->role == 'user'){
            $user->status = 'active';}

        if($request->role == 'consultant'){
            $user->status = 'pending';}

        // Remove the dd() to allow registration to complete
        // dd($user);
        $user->save();

        return redirect()->route('login')->with('success', 'Registration successful. Please log in.');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // dd($credentials);

        /* - The second parameter ( $request->has('remember') ) determines if the "remember me" functionality should be used
- It returns true if authentication succeeds, false otherwise */

        if (Auth::attempt($credentials, $request->has('remember'))) {
            // security feature to prevent session fixation attacks
            // best practice to regenerate the session ID after a successful login
            $request->session()->regenerate();
            
            // Redirect based on user role
            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role === 'consultant') {
                return redirect()->route('consultant.dashboard');
            } else {
                return redirect()->route('dashboard');
            }
        }

        return back()->withErrors([
            'email' => 'Les informations de connexion sont incorrectes.',
        ])->withInput($request->only('email'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}

