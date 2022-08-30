<?php

namespace App\Http\Controllers;

use App\Models\ItinerarySafariGeneralInfo;
use Illuminate\Http\Request;

class ItinerarySafariGeneralInfoController extends Controller
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
        return view('itineraries_safari_general_info.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        return redirect()->route('safari_lookbook.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ItinerarySafariGeneralInfo  $itinerarySafariGeneralInfo
     * @return \Illuminate\Http\Response
     */
    public function show(ItinerarySafariGeneralInfo $itinerarySafariGeneralInfo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ItinerarySafariGeneralInfo  $itinerarySafariGeneralInfo
     * @return \Illuminate\Http\Response
     */
    public function edit(ItinerarySafariGeneralInfo $itinerarySafariGeneralInfo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ItinerarySafariGeneralInfo  $itinerarySafariGeneralInfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ItinerarySafariGeneralInfo $itinerarySafariGeneralInfo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ItinerarySafariGeneralInfo  $itinerarySafariGeneralInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItinerarySafariGeneralInfo $itinerarySafariGeneralInfo)
    {
        //
    }
}
