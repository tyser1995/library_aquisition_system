<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\App;

class BookingController extends Controller
{
    function __construct()
    {        
        $this->middleware('permission:booking-list', ['only' => ['index']]);
        $this->middleware('permission:booking-create', ['only' => ['create','store']]);
        $this->middleware('permission:booking-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:booking-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('bookings.index');
    }

    public function bookings_data(){
        $token = Http::asForm()->post('https://accounts.zoho.com/oauth/v2/token', [
            'refresh_token' => '1000.11129e7b8a7c0d8b23d1660ecdd778bb.d5f13858625885abb0c84e79e30ff025',
            'client_id' => '1000.T2UARM0QPE49UGL9IM5B29Z5M5IQBW',
            'client_secret' => '917988f8df636c2bd7b9a44480106e1a30487194e4',
            'grant_type' => 'refresh_token',
        ]);
        // dd($token->json());
        $response = Http::withToken($token->json()['access_token'])
        ->get('https://www.zohoapis.com/crm/v2/bookings');
        // env('ZOHO_ACCESS_TOKEN', $token->json()['access_token']);
        // $response = Http::withToken($token->json()['access_token'])
        // ->get('https://www.zohoapis.com/crm/v2/bookings');
        // dd($response);
        return response()->json([
            'data' => $response->json()['data'],
            'info' => $response->json()['info']
        ]);

        // if($response->status() == 200){
        //     return response()->json([
        //         'data' => $response->json()['data'],
        //         'info' => $response->json()['info']
        //     ]);
        // }
        // else{
        //      $token = Http::asForm()->post('https://accounts.zoho.com/oauth/v2/token', [
        //         'refresh_token' => env('ZOHO_CRM_REFRESH_TOKEN'),
        //         'client_id' => env('ZOHO_CRM_CLIENT_ID'),
        //         'client_secret' => env('ZOHO_CRM_CLIENT_SECRET'),
        //         'grant_type' => 'refresh_token',
        //     ]);

        //     env('ZOHO_CRM_ACCESS_TOKEN', $token->json()['access_token']);
        //     $response = Http::withToken(env('ZOHO_CRM_ACCESS_TOKEN'))
        //     ->get('https://www.zohoapis.com/crm/v2/bookings');

        //     return view('bookings.index');
        //     //return response()->json(['error' => $response->json()['error']['message']], $response->status());
        // }
    }

    //Refresh_token
    public function refresh_token()
    {
        $response = Http::asForm()->post('https://accounts.zoho.com/oauth/v2/token', [
            'refresh_token' => env('ZOHO_CRM_REFRESH_TOKEN'),
            'client_id' => env('ZOHO_CRM_CLIENT_ID'),
            'client_secret' => env('ZOHO_CRM_CLIENT_SECRET'),
            'grant_type' => 'refresh_token',
        ]);

        dd($response->json());
        env('ZOHO_CRM_ACCESS_TOKEN', $response->json()['access_token']);
        return $response->json();
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        //
    }
}