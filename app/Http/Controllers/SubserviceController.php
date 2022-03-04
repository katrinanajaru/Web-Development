<?php

namespace App\Http\Controllers;

use App\Models\Subservice;
use App\Http\Requests\StoreSubserviceRequest;
use App\Http\Requests\UpdateSubserviceRequest;

class SubserviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSubserviceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSubserviceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subservice  $subservice
     * @return \Illuminate\Http\Response
     */
    public function show(Subservice $subservice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subservice  $subservice
     * @return \Illuminate\Http\Response
     */
    public function edit(Subservice $subservice)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subservice  $subservice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subservice $subservice)
    {
        //
    }
}
