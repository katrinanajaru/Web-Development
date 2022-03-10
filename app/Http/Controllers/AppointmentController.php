<?php

namespace App\Http\Controllers;

use App\Http\MpesaGateway;
use App\Models\User;
use App\Models\Service;
use App\Models\Subservice;
use App\Models\Appointment;
use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $appointments =Appointment::latest()->paginate(3);
        $appointmenttabless=Appointment::latest()->get();

        return view('admin.appointments.index',compact('appointments','appointmenttabless'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services=Service::all();
        $subservices  =Subservice::paginate(12);
        return view('admin.appointments.create',compact('services','subservices'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAppointmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAppointmentRequest $request)
    {
        $post=$request->validated();
        $post['employee_id']=User::where('role','employee')->get()->random();

        Appointment::create($post);

        return redirect()-> route('appointments.index')->with('success','You have successfully booked your selected service');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit(Appointment $appointment)
    {
        return view('admin.appointments.edit',compact('appointment'));
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

    public function payAppointment(Appointment $appointment, MpesaGateway $mpesa)
    {
        # stk push for payment

        $subservice = $appointment->subservice ;
        $response = $mpesa->lipaNaMPesaOnlineAPI( Auth::user()->phone,$subservice->price) ;
        $makepay = $subservice->payments()->create([
            'user_id'=> auth()->user()->id ,
            'MerchantRequestID'=> $response['MerchantRequestID'],
            'CheckoutRequestID'=> $response['CheckoutRequestID'],
            'ResponseCode'=> $response['ResponseCode'],
            'ResponseDescription'=> $response['ResponseDescription'],
            'CustomerMessage'=> $response['CustomerMessage'],
            'amount'=>$subservice->price
        ]) ;
        $appointment->status = "completed" ;
        $appointment->save();
        return back()->with('success', $response['CustomerMessage']) ;

    }
}
