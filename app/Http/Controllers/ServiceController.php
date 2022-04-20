<?php

namespace App\Http\Controllers;


use App\Models\Service;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services=Service::latest()->get();
        return view('admin.services.index',compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if ( Auth::user()->isClient() ) {
            Session::flash("error","Only Admins can create Service") ;
            return redirect()->route('services.index') ;
        }
        return view('admin.services.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreServiceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreServiceRequest $request)
    {
        if ( Auth::user()->isClient() ) {
            Session::flash("error","Only Admins can create Service") ;
            return redirect()->route('services.index') ;
        }
        $post=$request->validated();

        Service::create($post);

        return back()->with('success','You have successfully added the service');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        return view('admin.services.show',compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        if ( Auth::user()->isClient() ) {
            Session::flash("error","Only Admins can Edit Service") ;
            return redirect()->route('services.index') ;
        }
        return view('admin.services.edit',compact('service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateServiceRequest  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateServiceRequest $request, Service $service)
    {
        $post=$request->validated();

        $service->update($post);

        if($service)
        {
        return back()->with('success','You have successfully updated the service');
        }
        else
        {
           return  back()->with('error','An error occured, please try again or contact the manager');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        if (  Auth::user()->isClient() ) {
            Session::flash("error","Only Admins can delete Service") ;
            return redirect()->route('services.index') ;
        }
        $service->delete();

        if($service){
            return redirect()->route('services.index')->with('success','You have successfully deleted the record');
        }
        else{
            return back()->with('error','An error occured, please try again or contact the manager!');
        }
    }
}
