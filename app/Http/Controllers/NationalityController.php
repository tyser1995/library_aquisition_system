<?php

namespace App\Http\Controllers;

use App\Models\Nationality;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Helpers\GlobalHelper;

class NationalityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {        
        $this->middleware('permission:nationality-list', ['only' => ['index']]);
        $this->middleware('permission:nationality-create', ['only' => ['create','store','getNationalities']]);
        $this->middleware('permission:nationality-edit', ['only' => ['edit','update','getNationalities']]);
        $this->middleware('permission:nationality-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index(Nationality $model)
    {
        return view('nationalities.index', ['nationalities' => $model->orderBy('nationality_name','ASC')->paginate(15)]);
    }

    public function create()
    {
        $countries = Country::all();
        return view('nationalities.create', [
            'countries' => $countries
        ]);
    }

    public function store(Request $request, Nationality $model)
    {
        if ($request->isMethod('post'))
        {
            $nationality = Nationality::where('nationality_name','=', $request->input('nationality_name'))->get();
            if($nationality->first()){
                return redirect()->route('nationality.create')->withError(__('Nationality already exist'));
            }

            $nationality = new Nationality;
            $nationality->country_id = $request->input('country_id');
            $nationality->nationality_name = ucfirst($request->input('nationality_name'));
            // $nationality->nationality_code = ($request->input('nationality_code') != "" ? $request->input('nationality_code') : "");
            $nationality->created_by_user_id = Auth::user()->id;
            $nationality->save();

            return redirect()->route('nationalities')->withStatus(__('Nationality added'));
        }else{
            return redirect()->route('nationality.create')->withError(__('Invalid form entry'));
        }
    }

    public function edit(Nationality $nationality)
    {
        $countries = Country::all();
        return view('nationalities.edit', ['nationality' =>$nationality, 'countries' => $countries]);
    }


    public function update(Request $request, Nationality $nationality)
    {
        if ($request->isMethod('post') || $request->isMethod('put'))
        {
            if($nationality) {
                $nationality->country_id = $request->input('country_id');
                $nationality->nationality_name           = ucfirst($request->input('nationality_name'));
                $nationality->save();

                return redirect()->route('nationality.index')->withStatus(__('Nationality updated.'));
            }
        }
        return redirect()->route('nationality.edit', $nationality)->withError(__('Invalid form entry'));
    }

    public function destroy(Nationality $nationality)
    {
        if($nationality) {
            $nationality->delete();
            return redirect()->route('nationality.index')->withStatus(__('Nationality deleted'));
        }
        return redirect()->route('nationality.index')->withError(__('Unable to delete'));
    }


    public function getNationalities(Request $request)
    {
        $return = [];
        $all_nationalities = \GlobalHelper::getNationalities();
        $available_nationalities = \GlobalHelper::getNationalities();
        $existing_countries = Nationality::whereIn('nationality_name', \GlobalHelper::getNationalities())->get();
        foreach($existing_countries as $er){
            if(in_array($er->nationality_name, $all_nationalities) !== false){
                unset($available_nationalities[$er->nationality_name]);
            }
        }

        $search_text = $request->input('term');
        $available_nationalities = array_filter($available_nationalities, function($el) use ($search_text) {
            return ( stripos($el['nationality'], $search_text) !== false );
        });

        foreach($available_nationalities as $key => $value){
            $return[] = array('label' => $value['nationality'], 'value' => $value['nationality'], 'code' => $key);
        }
        return response()->json($return);
    }
}
