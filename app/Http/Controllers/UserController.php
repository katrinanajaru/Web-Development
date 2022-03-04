<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::latest()->get();
        $total_users = User::count() ;
        $total_employees =  User::where('role','employee')-> count() ;
        $total_managers =  User::where('role','manager')-> count() ;
        $total_customers =  User::where('role','client')-> count() ;
        return view('users.index',compact('users','total_users','total_customers','total_employees','total_managers')) ;

    }

    public function show(User $user)
    {
        return  view("users.show",compact('user'));
    }





    public function delete(User $user)
    {
        # code...
        if ( Storage::exists('storage/profile/'.$user->image) ) {
            # code...
            Storage::delete('storage/profile/'.$user->image);
        }
        $user->delete() ;

        return redirect()->route('users.index')->with('success',"user deleted") ;

    }



}
