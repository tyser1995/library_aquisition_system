<?php

namespace App\Http\Controllers;

use App\Models\ContentType;
use App\Models\ContentDetailTab;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Helpers\GlobalHelper;

class ContentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {       
        $this->middleware('permission:contenttype-list', ['only' => ['index']]);
        $this->middleware('permission:contenttype-create', ['only' => ['create','store','getRegions']]);
        $this->middleware('permission:contenttype-edit', ['only' => ['edit','update','getRegions']]);
        $this->middleware('permission:contenttype-delete', ['only' => ['destroy']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index(ContentType $model)
    {
        return view('content_types.index', ['content_types' => $model->orderBy('content_type_name','ASC')->paginate(15)]);
    }

    public function create()
    {
        $regions = Region::all();
        return view('content_types.create', [
            'regions' => $regions,
        ]);
    }

    public function store(Request $request, ContentType $model)
    {
        if ($request->isMethod('post'))
        {
            $content_type = ContentType::where('content_type_name','=', $request->input('content_type_name'))->get();
            if($content_type->first()){
                return redirect()->route('region.create')->withError(__('Content already exist'));
            }

            $content_type = new ContentType;
            $content_type->content_type_name = ucfirst($request->input('content_type_name'));
            $content_type->hasDetails = $request->has('hasDetails');
            $content_type->hasRooms = $request->has('hasRooms');
            $content_type->hasPages = $request->has('hasPages');
            $content_type->created_by_user_id = Auth::user()->id;
            $content_type->save();
          

            return redirect()->route('content_types')->withStatus(__('Content Type added'));
        }else{
            return redirect()->route('region.create')->withError(__('Invalid form entry'));
        }
    }

    public function edit(ContentType $content_type)
    {
        $regions = Region::all();
        return view('content_types.edit', ['content_type' =>$content_type, 'regions' => $regions]);
    }

    public function update(Request $request, ContentType $content_type)
    {
        if ($request->isMethod('post') || $request->isMethod('put'))
        {
            if($content_type) {
                $content_type->content_type_name           = ucfirst($request->input('content_type_name'));
                $content_type->hasDetails = $request->has('hasDetails');
                $content_type->hasRooms = $request->has('hasRooms');
                $content_type->hasPages = $request->has('hasPages');
                $content_type->save();

                return redirect()->route('content_type.index')->withStatus(__('Content Type updated.'));             
            }
        }
        return redirect()->route('content_type.edit', $content_type)->withError(__('Invalid form entry'));
    }

    public function destroy(ContentType $content_type)
    {
        if($content_type) {   
            $content_type->delete();
            return redirect()->route('content_type.index')->withStatus(__('Content Type deleted'));  
        }
        return redirect()->route('content_type.index')->withError(__('Unable to delete'));  
    }

    public function getContentTypes(Request $request)
    {
        $return = [];
        $all_content_types = \GlobalHelper::getContentTypes();
        $available_content_types = \GlobalHelper::getContentTypes();
        $existing_countries = ContentType::whereIn('content_type_name', \GlobalHelper::getContentTypes())->get();
        
        //$content_details_tabs = ContentDetailTab::where('id','=',$content_rooms_tabs->content_details_tabs_id)->get()->first();
        foreach($existing_countries as $er){
            if(in_array($er->content_type_name, $all_content_types) !== false){
                unset($available_content_types[$er->content_type_name]);
            }
        }

        $search_text = $request->input('term');
        $available_content_types = array_filter($available_content_types, function($el) use ($search_text) {
            return ( stripos($el['content_type'], $search_text) !== false );
        });

        foreach($available_content_types as $key => $value){
            $return[] = array('label' => $value['content_type'], 'value' => $value['content_type'], 'code' => $key);
        }
        return response()->json($return);
    }
}

