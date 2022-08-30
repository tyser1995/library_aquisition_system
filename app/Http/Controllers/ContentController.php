<?php

namespace App\Http\Controllers;

use App\Models\ContentType;
use App\Models\ContentDetailTab;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Helpers\GlobalHelper;

use Route;

class ContentController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $all_content_types = ContentType::orderBy('created_at','ASC')->get();
        $selected_content_type = ($request->input('id') != "" ? ContentType::findOrFail($request->input('id')) : ContentType::take(1)->first() );
        return view('contents.index', [
            'all_content_types' => $all_content_types,
            'selected_content_type' => $selected_content_type,
        ]);
    }

    public function getContents(Request $request) 
    {   
        
        $content_details_tabs_all = ContentDetailTab::where('content_type_id','=',$request->content_type_id)->orderBy('created_at','ASC')->get();
        
        return view('contents.get_contents',[
            'content_details_tabs' => $content_details_tabs_all
        ]);
    }

    public function store(Request $request)
    {
        $content_type = new ContentType;
        $content_type = ContentType::where('content_type_name','=', $request->input('content_type_name'))->get();
        if($content_type->first()){
            return redirect()->back()->withError(__('Content already exist'));
        }

        $content_type = new ContentType;
        $content_type->content_type_name = ucfirst($request->input('content_type_name'));
        $content_type->hasDetails = $request->has('hasDetails');
        $content_type->hasRooms = $request->has('hasRooms');
        $content_type->hasPages = $request->has('hasPages');
        $content_type->created_by_user_id = Auth::user()->id;
        $content_type->save();
       
        return redirect()->back()->withStatus(__('Content Type added'));
    }
    public function quickAddContentType(Request $request)
    {
        // $result = [];
        // if ($request->isMethod('post')) {
        //     $content_type = ContentType::where('content_type_name','=', $request->input('content_type_name'))->get();
        //     if($content_type->first()){
        //         $result = ['is_success' => 0, 'message' => 'Content type already exist']; 
        //         return response()->json($result);
        //     }

        //     $content_type = new ContentType;
        //     $content_type->content_type_name = ucfirst($request->input('content_type_name'));
        //     $content_type->created_by_user_id = Auth::user()->id;
        //     $content_type->save();

        //     if($content_type->id > 0){
        //         $result = ['is_success' => 1, 'message' => 'Content type added', 'content_type_id' => $content_type->id]; 
        //     }else{
        //         $result = ['is_success' => 0, 'message' => 'Unable to save content type']; 
        //     }
            
        // } else {
        //     $result = ['is_success' => 0, 'message' => 'Invalid form request']; 
        // }
        
        //  return response()->json($result);
    }

}