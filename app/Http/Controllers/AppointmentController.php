<?php
namespace App\Http\Controllers;

use App\Http\Payments\Money;
use App\Http\Payments\MpesaGateway;
use App\Models\User;
use App\Models\Service;
use App\Models\Subservice;
use App\Models\Appointment;
use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use App\Models\Wallet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {



        if (auth()->user()->isEmployee() ||auth()->user()->isManager()) {
            # code...
            $appointments = Appointment::latest()->paginate(3);
            $appointmenttabless = Appointment::latest()->get();
        } else {
            # code...
            $appointments = Appointment::where('user_id', auth()->user()->id)->latest()->paginate(3);
            $appointmenttabless = Appointment::where('user_id', auth()->user()->id)->latest()->get();
        }


        return view('admin.appointments.index', compact('appointments', 'appointmenttabless'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::all();
        $subservices  = Subservice::paginate(12);
        return view('admin.appointments.create', compact('services', 'subservices'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAppointmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAppointmentRequest $request)
    {
        $post = $request->validated();
        $route = "";
        if(User::where('role', 'employee')->count() >= 1){
            $post['employee_id'] = User::where('role', 'employee')->get()->random()->pluck('id')[0] ;
            Appointment::create($post);
            Session::flash('success', 'You have successfully booked your selected service') ;
            $route = 'appointments.index' ;

        }else{
            Session::flash("error","Please wait for admin to add new employees for this service") ;
            $route = 'appointments.index' ;
        }


        return redirect()->route($route);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment)
    {
        return view('admin.appointments.show',compact('appointment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit(Appointment $appointment)
    {
        return view('admin.appointments.edit', compact('appointment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAppointmentRequest  $request
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAppointmentRequest $request, Appointment $appointment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment)
    {
        //
    }

    public function payAppointment(Appointment $appointment)
    {
        # stk push for payment
        $mpesa = new Money();

        $subservice = $appointment->subservice;

        try {
            $response = $mpesa->lipaNaMPesaOnlineAPI(Auth::user()->phone, $subservice->price);
            $makepay = $subservice->payments()->create([
                'user_id' => auth()->user()->id,
                'MerchantRequestID' => $response['MerchantRequestID'],
                'CheckoutRequestID' => $response['CheckoutRequestID'],
                'ResponseCode' => $response['ResponseCode'],
                'ResponseDescription' => $response['ResponseDescription'],
                'CustomerMessage' => $response['CustomerMessage'],
                'amount' => $subservice->price
            ]);
            $appointment->status = "completed";
            $appointment->save();

            $current_wallet = Wallet::latest()->first();
            if( $current_wallet){
                $balance = $current_wallet->balance +  $subservice->price ;
            }else{
                $balance = 0 ;
            }

            Wallet::create([
                'balance' => $balance ,
                'moneyin'=>$subservice->price
            ]) ;

        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error', "Please Check Your number format in your profile!");
        }


        return back()->with('success', $response['CustomerMessage']);
    }

    public function approveAppointment(Appointment $appointment)
    {
        $status = request('status') ;
        // return $status ;
        $appointment->status = $status ;

        if ( $appointment->save()) {
            # code...

            Session::flash('success',"Appointment ". $status ) ;
        }else{
            Session::flash('error',"Error occured" ) ;
        }
        return back();
    }
}
