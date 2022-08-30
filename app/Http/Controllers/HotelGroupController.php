<?php

namespace App\Http\Controllers;

use App\Models\HotelGroup;
use App\Models\Country;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Helpers\GlobalHelper;

class HotelGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {        
        $this->middleware('permission:hotelgroup-list', ['only' => ['index']]);
        $this->middleware('permission:hotelgroup-create', ['only' => ['create','store']]);
        $this->middleware('permission:hotelgroup-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:hotelgroup-delete', ['only' => ['destroy']]);
    }
    public function index(HotelGroup $model)
    {
        return view('hotel_groups.index', ['hotel_groups' => $model->orderBy('hotel_group_name','ASC')->paginate(15)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::all();
        return view('hotel_groups.create', [
            'countries' => $countries
        ]);
    }

    public function store(Request $request, HotelGroup $model)
    {
        if ($request->isMethod('post'))
        {
            $hotel_group = HotelGroup::where('hotel_group_name','=', $request->input('hotel_group_name'))->get();
            if($hotel_group->first()){
                return redirect()->route('hotel_group.create')->withError(__('Hotel Group already exist'));
            }
            
            $hotel_group = new HotelGroup;
            // $hotel_group->country_id = $request->input('country_id');
            $hotel_group->hotel_group_name = ucfirst($request->input('hotel_group_name'));
            $hotel_group->save();
            
            return redirect()->route('hotel_groups')->withStatus(__('Hotel added'));
        }
    }


    public function show($id)
    {
        $hotel_group = HotelGroup::find($id);
        $countries = Country::all();
        $hotels = Hotel::where('hotel_group_id','=',$hotel_group->id)->get();
        $hotels_dropdown = Hotel::where('hotel_group_id','=', 0)->get();
        return view('hotel_groups.view', [
            'countries' => $countries,
            'hotels' => $hotels,
            'hotel_groups'=> $hotel_group,
            'hotels_dropdown' => $hotels_dropdown
        ]);

    }

    public function updateHotelGroupId(Request $request) 
    {
        if ($request->isMethod('post') || $request->isMethod('put'))
        {
            $hotel_group = HotelGroup::find($request->input('hotel_group_id'));
            $hotel = Hotel::find($request->input('hotel_id'));
            if($hotel) 
            {
               $hotel->hotel_group_id = $request->input('hotel_group_id');  
               $hotel->save(); 
            }
            return redirect()->route('hotel_group.show', $hotel_group)->withStatus(__('Hotel Group updated.'));
            
        }
        return redirect()->route('hotel_group.show', $hotel_group)->withError(__('Invalid form entry'));
    }

    public function edit(HotelGroup $hotel_group)
    {
        $countries = Country::all();
        return view('hotel_groups.edit', ['hotel_group' =>$hotel_group, 'countries' => $countries]);
    }

    public function update(Request $request, HotelGroup $hotel_group)
    {
        if ($request->isMethod('post') || $request->isMethod('put'))
        {
            if($hotel_group) {
                // $hotel_group->country_id = $request->input('country_id');
                $hotel_group->hotel_group_name           = ucfirst($request->input('hotel_group_name'));
                $hotel_group->save();

                return redirect()->route('hotel_group.index')->withStatus(__('Hotel Group updated.'));
            }
        }
        return redirect()->route('hotel_group.edit', $hotel_group)->withError(__('Invalid form entry'));
    }

    public function unassignHotelGroupId(Request $request) 
    {
        if ($request->isMethod('post') || $request->isMethod('put'))
        {
            $hotel_group = HotelGroup::find($request->input('hotel_group_id'));
            $hotel = Hotel::find($request->input('hotel_id'));
            if($hotel) 
            {
               $hotel->hotel_group_id = 0;  
               $hotel->save(); 
            }
            return redirect()->route('hotel_group.show', $hotel_group)->withStatus(__('Hotel Group unassigned.'));
            
        }
        return redirect()->route('hotel_group.show', $hotel_group)->withError(__('Invalid form entry'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(HotelGroup $hotel_group)
    {
        if($hotel_group) {   
            $hotel_group->delete();
            return redirect()->route('hotel_group.index')->withStatus(__('Hotel deleted'));  
        }
        return redirect()->route('hotel_group.index')->withError(__('Unable to delete'));  
    }
}
