<?php

namespace App\Http\Controllers;

use App\Models\attendance;
use App\Http\Requests\StoreattendanceRequest;
use App\Http\Requests\UpdateattendanceRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (Auth::user()->role ==  "manager") {
            # code...
            $attendances = attendance::latest()->get();
        } else {
            # code...
            $attendances = attendance::where('employee_id',Auth::user()->id)-> latest()->get();
        }

        return view('admin.attendance.attendance',compact('attendances')) ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $attendance = attendance::where('employee_id',  Auth::user()->id)->where('active',true)->first();

        if ($attendance) {
            # code...
            return redirect()->route('attendance.edit',$attendance) ;
        }

        return view('admin.attendance.create') ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreattendanceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreattendanceRequest $request)
    {
        $data = $request->validated() ;


        attendance::create($data) ;

        return redirect()->route('attendance.leave')->with('success',"Your arrive time is saved") ;



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function show(attendance $attendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function edit(attendance $attendance)
    {
        abort_if($attendance->employee_id != Auth::user()->id,403,"You cant view this") ;
        return view('admin.attendance.edit',compact('attendance')) ;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateattendanceRequest  $request
     * @param  \App\Models\attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateattendanceRequest $request, attendance $attendance)
    {
        $attendance->update($request->validated() ) ;
        return redirect()->route('attendance.index')->with('success',"Your leave time is saved") ;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(attendance $attendance)
    {
        $attendance->delete() ;
        return redirect()->route('attendance.index')->with('success',"Your leave attendance deleted") ;


    }
}
