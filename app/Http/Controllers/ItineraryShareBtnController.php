<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ItineraryShareBtnController extends Controller
{
    public function index()
    {
        return view('itineraries.sub_table');
    }
}
