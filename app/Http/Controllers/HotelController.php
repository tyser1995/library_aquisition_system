<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Helpers\GlobalHelper;
use App\Imports\HotelImport;
use Excel;



class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    function __construct()
    {        
        $this->middleware('permission:hotel-list', ['only' => ['index']]);
        $this->middleware('permission:hotel-create', ['only' => ['create','store']]);
        $this->middleware('permission:hotel-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:hotel-delete', ['only' => ['destroy']]);
    }
    public function index(Hotel $model)
    {
        return view('hotels.index', ['hotels' => $model->orderBy('hotel_name','ASC')->paginate(15)]);
        
    }

    public function create()
    {
        $countries = Country::all();
        return view('hotels.create', ['countries' => $countries]);
    }

    public function import()
    {
        $countries = Country::all();
        return view('hotels.import', ['countries' => $countries]);
    }

    public function storeImport(Request $request, Hotel $model)
    {
        $file = $request->file('file');
        Excel::import(new HotelImport($request->input('country_id'),2), $file);
        return back()->withStatus('Excel file imported successfully');
    }

    public function store(Request $request, Hotel $model)
    {
        if ($request->isMethod('post'))
        {
            $hotel = new Hotel;
            $hotel->hotel_name = ucfirst($request->input('hotel_name'));
            $hotel->country_id = $request->input('country_id');
            $hotel->website = $request->input('website');
            $hotel->address = $request->input('address');
            $hotel->latitude  = $request->input('hotel_lat');
            $hotel->longitude = $request->input('hotel_long');

            $array_contact_number = $request->input('contact_number');
            $contact_numbers      = implode(", " ,$array_contact_number);
            $hotel->phone_number  = $contact_numbers;

            $array_room_types = $request->input('room_type');
            $room_types = implode(", " ,$array_room_types);
            $hotel->room_type = $room_types;
            $hotel->created_by_user_id = Auth::user()->id;
            $hotel->save();

            
            return redirect()->route('hotels')->withStatus(__('Hotel added'));
        }
    }

    
    public function edit(Hotel $hotel)
    {
        $countries = Country::all();
        $array_contact_numbers = explode(", " , $hotel->phone_number); 
        $array_room_types      = explode(", " , $hotel->room_type);
        return view('hotels.edit',['hotel' => $hotel, 'countries' => $countries, 'array_room_types' => $array_room_types, 'array_contact_numbers' => $array_contact_numbers]);
    }

    public function update(Request $request, Hotel $hotel)
    {
        if ($request->isMethod('post') || $request->isMethod('put'))
        {
            if($hotel) {
                $hotel->hotel_name          = ucfirst($request->input('hotel_name'));
                $hotel->country_id          = $request->input('country_id');
                $hotel->website             = ucfirst($request->input('website'));                
                $array_contact_numbers      = $request->input('contact_number');
                $contact_numbers            = implode(", " ,$array_contact_numbers);
                $hotel->phone_number        = $contact_numbers;                
                $hotel->address             = $request->input('address');
                $hotel->latitude            = $request->input('hotel_lat');
                $hotel->longitude           = $request->input('hotel_long');
                $array_room_types           = $request->input('room_type');
                $room_types                 = implode(", " ,$array_room_types);
                $hotel->room_type           = $room_types;
                $hotel->save();

                return redirect()->route('hotel.index')->withStatus(__('Hotel updated.'));             
            }
        }
        return redirect()->route('hotel.edit', $hotel)->withError(__('Invalid form entry'));
    }

    public function destroy(Hotel $hotel)
    {
        if($hotel) {   
            $hotel->delete();
            return redirect()->route('hotel.index')->withStatus(__('Hotel deleted'));  
        }
        return redirect()->route('hotel.index')->withError(__('Unable to delete'));  
    }

}