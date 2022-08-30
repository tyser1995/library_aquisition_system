<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Helpers\GlobalHelper;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {       
        $this->middleware('permission:region-list', ['only' => ['index']]);
        $this->middleware('permission:region-create', ['only' => ['create','store','getRegions']]);
        $this->middleware('permission:region-edit', ['only' => ['edit','update','getRegions']]);
        $this->middleware('permission:region-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index(Region $model)
    {
        return view('regions.index', ['regions' => $model->orderBy('region_name','ASC')->paginate(15)]);
    }

    public function create()
    {
        return view('regions.create', [
            
        ]);
    }

    public function store(Request $request, Region $model)
    {
        if ($request->isMethod('post'))
        {
            $region = Region::where('region_name','=', $request->input('region_name'))->get();
            if($region->first()){
                return redirect()->route('region.create')->withError(__('Region already exist'));
            }

            $region = new Region;
            $region->region_name = ucfirst($request->input('region_name'));
            $region->created_by_user_id = Auth::user()->id;
            $region->save();

            return redirect()->route('regions')->withStatus(__('Region added'));
        }else{
            return redirect()->route('region.create')->withError(__('Invalid form entry'));
        }
    }

    public function edit(Region $region)
    {
        return view('regions.edit', ['region' =>$region]);
    }

    public function update(Request $request, Region $region)
    {
        if ($request->isMethod('post') || $request->isMethod('put'))
        {
            if($region) {
                $region->region_name           = ucfirst($request->input('region_name'));
                $region->save();

                return redirect()->route('region.index')->withStatus(__('Region updated'));             
            }
        }
        return redirect()->route('region.edit', $region)->withError(__('Invalid form entry'));
    }

    public function destroy(Region $region)
    {
        if($region) {   
            $region->delete();
            return redirect()->route('region.index')->withError(__('Region deleted'));  
        }
        return redirect()->route('region.index')->withError(__('Unable to delete'));  
    }


    public function getRegions(Request $request)
    {
        $return = [];
        $all_regions = \GlobalHelper::getRegions();
        $available_regions = \GlobalHelper::getRegions();
        $existing_regions = Region::whereIn('region_name', \GlobalHelper::getRegions())->get();
        foreach($existing_regions as $er){
            if(in_array($er->region_name, $all_regions) !== false){
                unset($available_regions[$er->region_name]);
            }
        }

        $search_text = $request->input('term');
        $available_regions = array_filter($available_regions, function($el) use ($search_text) {
            return ( stripos($el, $search_text) !== false );
        });

        foreach($available_regions as $value){
            $return[] = array('label' => $value, 'value' => $value);
        }
        return response()->json($return);
    }

}
