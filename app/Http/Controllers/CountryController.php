<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Helpers\GlobalHelper;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {       
        $this->middleware('permission:country-list', ['only' => ['index']]);
        $this->middleware('permission:country-create', ['only' => ['create','store','getRegions']]);
        $this->middleware('permission:country-edit', ['only' => ['edit','update','getRegions']]);
        $this->middleware('permission:country-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index(Country $model)
    {
        return view('countries.index', [
            'countries' => $model->orderBy('country_name','ASC')->paginate(15)
        ]);
    }

    public function create()
    {
        $regions = Region::all();
        return view('countries.create', [
            'regions' => $regions
        ]);
    }

    public function store(Request $request, Country $model)
    {
        if ($request->isMethod('post'))
        {
            $country = Country::where('country_name','=', $request->input('country_name'))->get();
            if($country->first()){
                return redirect()->route('country.create')->withError(__('Country already exist'));
            }

            $country = new Country;
            $country->region_id = $request->input('region_id');
            $country->country_name = ucfirst($request->input('country_name'));
            $country->country_code = ($request->input('country_code') != "" ? $request->input('country_code') : "");
            $country->created_by_user_id = Auth::user()->id;
            $country->save();

            return redirect()->route('countries')->withStatus(__('Country added'));
        }else{
            return redirect()->route('country.create')->withError(__('Invalid form entry'));
        }
    }

    public function edit(Country $country)
    {
        $regions = Region::all();
        return view('countries.edit', ['country' =>$country, 'regions' => $regions]);
    }

    public function update(Request $request, Country $country)
    {
        if ($request->isMethod('post') || $request->isMethod('put'))
        {
            if($country) {
                $country->country_name           = ucfirst($request->input('country_name'));
                $country->save();

                return redirect()->route('country.index')->withStatus(__('Country updated'));
            }
        }
        return redirect()->route('country.edit', $country)->withError(__('Invalid form entry'));
    }

    public function destroy(Country $country)
    {
        if($country) {
            $country->delete();
            return redirect()->route('country.index')->withStatus(__('Country deleted'));
        }
        return redirect()->route('country.index')->withError(__('Unable to delete'));
    }


    public function getCountries(Request $request)
    {
        $return = [];
        $all_countries = \GlobalHelper::getCountries();
        $available_countries = \GlobalHelper::getCountries();
        $arr_countries = [];
        foreach($all_countries as $key => $cname){
            $arr_countries[] = $cname['country'];
        }
        $existing_regions = Country::whereIn('country_name', $arr_countries)->get();
        foreach($existing_regions as $er){
            if(in_array($er->country_name, $all_countries) !== false){
                unset($available_countries[$er->country_name]);
            }
        }

        $search_text = $request->input('term');
        $available_countries = array_filter($available_countries, function($el) use ($search_text) {
            return ( stripos($el['country'], $search_text) !== false );
        });

        foreach($available_countries as $key => $value){
            $return[] = array('label' => $value['country'], 'value' => $value['country'], 'code' => $key);
        }
        return response()->json($return);
    }

}
