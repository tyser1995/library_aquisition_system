<?php

namespace App\Http\Controllers;

use App\Models\ItinerarySafariLookBook;
use Illuminate\Http\Request;

class ItinerarySafariLookBookController extends Controller
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
        return view('itineraries_safari_lookbook.create');
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
        return redirect()->route('itineraries.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ItinerarySafariLookBook  $itinerarySafariLookBook
     * @return \Illuminate\Http\Response
     */
    public function show(ItinerarySafariLookBook $itinerarySafariLookBook)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ItinerarySafariLookBook  $itinerarySafariLookBook
     * @return \Illuminate\Http\Response
     */
    public function edit(ItinerarySafariLookBook $itinerarySafariLookBook)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ItinerarySafariLookBook  $itinerarySafariLookBook
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ItinerarySafariLookBook $itinerarySafariLookBook)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ItinerarySafariLookBook  $itinerarySafariLookBook
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItinerarySafariLookBook $itinerarySafariLookBook)
    {
        //
    }
}
