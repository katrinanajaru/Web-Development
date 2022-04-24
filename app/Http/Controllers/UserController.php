<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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

    public function create(){
        return view("users.create") ;
    }

    public function show(User $user)
    {
        return  view("users.show",compact('user'));
    }

    public function store( Request $request)
    {
        # code...
        $data = $request->validate([
            'name'=>["required",'string'] ,
            'role'=>["required",'string'] ,
            'email' => ['required', 'email', 'max:255',  'unique:users,email,except,id'],
            'phone' => ['required', 'max:255',  'unique:users,phone,except,id'],
            'image' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],

        ]) ;
        $user = new User();

        if (file_exists($request->file('image'))) {
            // dd($request);
             // Get filename with extension
             $filenameWithExt = $request->file('image')->getClientOriginalName();



             // Get extension
             $extension = $request->file('image')->getClientOriginalExtension();

             // Create new filename
             $filenameToStore = (string) Str::uuid() . '_' . time() . '.' . $extension;

             // Uplaod image

             $path = $request->file('image')->storeAs('public/profile', $filenameToStore);
             $avatar  = $filenameToStore;
             $user->image = $avatar ;
            }

            $user ->name =  $data['name'];
            $user ->role =  $data['role'];
        $user ->email =  $data['email'];
        $user ->phone =  $data['phone'];
        $user->password = Hash::make("password") ;
        $user->save();
        return redirect()->route('users.index')->with('success',"user created") ;



    }





    public function destroy(User $user)
    {
        # code...
        if ( Storage::exists('storage/profile/'.$user->image) ) {
            # code...
            Storage::delete('storage/profile/'.$user->image);
        }
        if ($user->appointments->count() >0) {
            $user->payments->each->delete();
            $user->appointments->each->delete();
        }
        if ( $user->attedances->count() > 0 ) {
            # code...
            $user->attedances->each->delete();
        }
        $user->delete() ;

        return redirect()->route('users.index')->with('success',"user deleted") ;

    }

    public function update(Request $request, User $user)
    {
        // return $request ;
       $data = $request->validate([
            'name'=>["required",'string'] ,
            'email' => ['required', 'email', 'max:255',  Rule::unique('users')->ignore($user->id)],
            'phone' => ['required', 'max:255',  Rule::unique('users')->ignore($user->id)],
            'image' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
            'current_password' =>["required"]
        ]) ;

        if ( ! Hash::check($request['current_password'], $user->password)) {
            Session::flash('error','The provided password does not match your current password.' ) ;
            // $validator->errors()->add('current_password', __('The provided password does not match your current password.'));
            return back();
        }


        // return $data['phone'] ;


        if (file_exists($request->file('image'))) {
            // dd($request);
             // Get filename with extension
             $filenameWithExt = $request->file('image')->getClientOriginalName();



             // Get extension
             $extension = $request->file('image')->getClientOriginalExtension();

             // Create new filename
             $filenameToStore = (string) Str::uuid() . '_' . time() . '.' . $extension;

             // Uplaod image

             $path = $request->file('image')->storeAs('public/profile', $filenameToStore);
             $avatar  = $filenameToStore;
             $user->image = $avatar ;
            }




        $user ->name =  $data['name'];
        $user ->email =  $data['email'];
        $user ->phone =  $data['phone'];
        $user->save();

        Session::flash('success','Profile updated' ) ;

        return redirect()->route('users.show',$user) ;


    }



}
