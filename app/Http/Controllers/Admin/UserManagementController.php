<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\ConsultantApproved;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    public function index()
    {
        // Change from User::all() to User::paginate()
        $users = User::paginate(10); // Show 10 users per page
        return view('admin.users.index', compact('users'));
    }

    // approuver les consultants
    public function approve(Request $request){
      $user = User::find(request()->id);
      $user->status = 'active';
      $user->save();
      
      // Send notification to the consultant
      $user->notify(new ConsultantApproved());
      
      return redirect()->back()->with('success', 'Consultant approuvé avec succès. Un e-mail de notification a été envoyé.');
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
        
        return redirect()->back()->with('success', 'User activated successfully');
     }

     public function delete(Request $request){
        $user = User::find(request()->id);
        $user->delete();
        return redirect()->back()->with('success', 'User deleted successfully');    
     }
}
