<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\App;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('/refresh_token', function () {

//     $response = Http::asForm()->post('https://accounts.zoho.com/oauth/v2/token', [
//         'refresh_token' => env('ZOHO_CRM_REFRESH_TOKEN'),
//         'client_id' => env('ZOHO_CRM_CLIENT_ID'),
//         'client_secret' => env('ZOHO_CRM_CLIENT_SECRET'),
//         'grant_type' => 'refresh_token',
//     ]);

//     env('ZOHO_CRM_ACCESS_TOKEN', $response->json()['access_token']);
//     return $response->json();

// });

// Route::get('/bookings', function () {
//     $response = Http::withToken(env('ZOHO_CRM_ACCESS_TOKEN'))
//     ->get('https://www.zohoapis.com/crm/v2/bookings');

    
//     return response()->json([
//         'data' => $response->json()['data']
//     ]);
// });