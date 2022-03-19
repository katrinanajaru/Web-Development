<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Subservice;
use Illuminate\Support\Str;
use App\Http\Requests\StoreSubserviceRequest;
use App\Http\Requests\UpdateSubserviceRequest;

class SubserviceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subservices = Subservice::latest()->get();
        return view('admin.subservices.index',compact('subservices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::latest()->get();
        // return $services ;
        return view('admin.subservices.create',compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSubserviceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSubserviceRequest $request)
    {


        $post = $request->validated();

        if (file_exists($request->file('image'))) {
            // dd($request);
             // Get filename with extension
             $filenameWithExt = $request->file('image')->getClientOriginalName();



             // Get extension
             $extension = $request->file('image')->getClientOriginalExtension();

             // Create new filename
             $filenameToStore = (string) Str::uuid() . '_' . time() . '.' . $extension;

             // Uplaod image

             $path = $request->file('image')->storeAs('public/subservices', $filenameToStore);
             $avatar  = $filenameToStore;
            }

             $post = new Subservice();

            $post->name = $request->name;
            $post->image = $avatar ;
            $post->service_id=$request->service_id;
            $post->description=$request->description;
            $post->price=$request->price;

            $validate=$post->save();

            if ($validate) {

                return back()->with('success','You have successfully added the sub-service');

            }
            else {
                return back()->with('error','An error occured , please try again or contact the administrator');
            }




    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subservice  $subservice
     * @return \Illuminate\Http\Response
     */
    public function show(Subservice $subservice)
    {
        return view('admin.subservices.show',compact('subservice'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subservice  $subservice
     * @return \Illuminate\Http\Response
     */
    public function edit(Subservice $subservice)
    {
        $services = Service::all();
        return view('admin.subservices.edit',compact('subservice','services'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSubserviceRequest  $request
     * @param  \App\Models\Subservice  $subservice
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSubserviceRequest $request, Subservice $subservice)
    {
        $post = $request->validated();

        if (file_exists($request->file('image'))) {
            // dd($request);
             // Get filename with extension
             $filenameWithExt = $request->file('image')->getClientOriginalName();



             // Get extension
             $extension = $request->file('image')->getClientOriginalExtension();

             // Create new filename
             $filenameToStore = (string) Str::uuid() . '_' . time() . '.' . $extension;

             // Uplaod image

             $path = $request->file('image')->storeAs('public/subservices', $filenameToStore);
             $avatar  = $filenameToStore;
             $post['image'] =$avatar;
            }

            $subservice->update($post);

            if ($post) {

                return back()->with('success','You have successfully updated the sub-service');

            }
            else {
                return back()->with('error','An error occured , please try again or contact the administrator');
            }



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subservice  $subservice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subservice $subservice)
    {
        $subservice->delete();

        if($subservice){

            return redirect()->route('subservices.index')->with('success','You have successfully deleted the sub-service');

        }else{

            return back()->with('error','An error occured , please try again or contact the administrator');


        }
    }
}
