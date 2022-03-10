<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Service;
use App\Models\Subservice;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $noofemployees = User::where('role','employee')->count();
        $noofclients=User::where('role','client')->count();
        $noofsubservices= Subservice::count();
        // dd($noofclients) ;
        $noofservices=Service::count();
        $services = Service::latest()->get();
        return view('admin.home',compact('services','noofemployees','noofclients','noofservices','noofsubservices'));
    }
}
