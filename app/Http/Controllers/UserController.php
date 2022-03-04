<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

use Illuminate\Validation\Rule;


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

    public function update(Request $request, User $user)
    {
        // return $request ;
       $data = $request->validate([
            'email' => ['required', 'email', 'max:255',  Rule::unique('users')->ignore($user->id)],
            'phone' => ['required', 'max:255',  Rule::unique('users')->ignore($user->id)],
            'image' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024']
        ]) ;

        if (! isset($request['current_password']) || !  Hash::check($request['current_password'], $user->password)) {
            Session::flash('error','The provided password does not match your current password.' ) ;
            // $validator->errors()->add('current_password', __('The provided password does not match your current password.'));
        }

        $user->update($data) ;

        Session::flash('success','The provided password does not match your current password.' ) ;

        return redirect()->route('users.show',$user) ;


    }



}
