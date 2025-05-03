<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Mail\ConsultantApproved;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;


class UserManagementController extends Controller
{
    public function index()
    {
        // Change from User::all() to User::paginate()
        $users = User::paginate(10); // Show 10 users per page
        return view('admin.users.index', compact('users'));
    }

    // approuver les consultants
    public function approve(Request $request)
    {
        // Get the user ID explicitly from the request
        $userId = $request->id;
        
        // Debug logging to see what ID we're working with
        Log::info("Attempting to approve consultant with ID: " . $userId);
        
        $user = User::find($userId);
                
        // Update status
        $user->status = 'active';
        $user->save();
        
        return redirect()->back()->with('success', 'User activated successfully');

    }

    // rejecting consultant
    public function reject(Request $request){
        $user = User::find(request()->id);
        $user->status = 'inactive';
        $user->save();
        
        return redirect()->back()->with('success', 'Consultant rejected successfully');
    }

    public function activate(Request $request){
        $user = User::find(request()->id);
        $user->status = 'active';
        $user->save();
        Mail::to($user->email)->send(new \App\Mail\ConsultantApproved($user));

        
        return redirect()->back()->with('success', 'User activated successfully');
    }

    public function delete(Request $request){
        $user = User::find(request()->id);
        $user->delete();
        return redirect()->back()->with('success', 'User deleted successfully');    
    }
}
