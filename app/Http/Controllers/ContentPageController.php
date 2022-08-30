<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContentType;
use App\Models\Media;
use App\Models\Tag;
use App\Models\ContentPage;
use App\Models\ContentRoomTab;
use App\Models\Country;
use App\Models\ContentDetailTab;
use App\Models\ItineraryEditor;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image as Image;

class ContentPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $content_type = ContentType::find($id);
        $countries = Country::all();        
        $contentDetailTab = ContentDetailTab::where('content_type_id',$content_type->id)->get()->last();
        $ContentRoomTab = ContentRoomTab::where('content_type_id',$content_type->id)->get()->last();
        $content = ItineraryEditor::where('content_details_tab_and_itinerary_general_info_tab_id',$contentDetailTab->id)->get();
        return view('content_pages.index',[
            'content_type'=>$content_type,
            'countries' => $countries,
            'content_details_tabs' => $contentDetailTab,
            'content'=>$content,
        ]);
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
        $editor = new ItineraryEditor;
        $editor->title = $request->title;
        $editor->description = $request->description;
        $editor->html_entities = htmlspecialchars($request->description);
        $editor->content_details_tab_and_itinerary_general_info_tab_id = $request->content_details_tab_and_itinerary_general_info_tab_id_store;
        $editor->save();
        $content_type = ContentType::find($request->content_type_id_store);

        $content_pages_tabs = new ContentPage;
        $content_pages_tabs->content_details_tabs_id = $request->content_details_tab_and_itinerary_general_info_tab_id_store;
        $content_pages_tabs->media_id = $request->content_details_tab_and_itinerary_general_info_tab_id_store;
        $content_pages_tabs->image = $request->content_details_tab_and_itinerary_general_info_tab_id_store;
        $content_pages_tabs->detail_type = $request->content_details_tab_and_itinerary_general_info_tab_id_store;
        $content_pages_tabs->order = $request->content_details_tab_and_itinerary_general_info_tab_id_store;
        $content_pages_tabs->detail_name = $request->content_details_tab_and_itinerary_general_info_tab_id_store;
        $content_pages_tabs->detail_value = $request->content_details_tab_and_itinerary_general_info_tab_id_store;

        $content_pages_tabs_exist = DB::table('content_pages_tabs')
            ->select('content_details_tabs_id')
            ->where('content_details_tabs_id', $request->content_details_tab_and_itinerary_general_info_tab_id_store)
            ->get();
            
        if(count($content_pages_tabs_exist) < 1)
            $content_pages_tabs->save();

        if ($editor) {
            return redirect()->route('library/content/pages',$request->content_type_id)->withStatus('Content Pages Created!!!');
        } else {
            return back()->with("failed", "Failed! Itineraries not created");
        }
    }

    public function add_another(Request $request)
    {
        $editor = new ItineraryEditor;
        $editor->title = $request->title;
        $editor->description = $request->description;
        $editor->html_entities = htmlspecialchars($request->description);
        $editor->content_details_tab_and_itinerary_general_info_tab_id = $request->content_details_tab_and_itinerary_general_info_tab_id_store;
        $editor->save();
        $content_type = ContentType::find($request->content_type_id_store);

        $content_pages_tabs = new ContentPage;
        $content_pages_tabs->content_details_tabs_id = $request->content_details_tab_and_itinerary_general_info_tab_id_store;
        $content_pages_tabs->media_id = $request->content_details_tab_and_itinerary_general_info_tab_id_store;
        $content_pages_tabs->image = $request->content_details_tab_and_itinerary_general_info_tab_id_store;
        $content_pages_tabs->detail_type = $request->content_details_tab_and_itinerary_general_info_tab_id_store;
        $content_pages_tabs->order = $request->content_details_tab_and_itinerary_general_info_tab_id_store;
        $content_pages_tabs->detail_name = $request->content_details_tab_and_itinerary_general_info_tab_id_store;
        $content_pages_tabs->detail_value = $request->content_details_tab_and_itinerary_general_info_tab_id_store;

        $content_pages_tabs_exist = DB::table('content_pages_tabs')
            ->select('content_details_tabs_id')
            ->where('content_details_tabs_id', $request->content_details_tab_and_itinerary_general_info_tab_id_store)
            ->get();
            
        if(count($content_pages_tabs_exist) < 1)
            $content_pages_tabs->save();

        if ($editor) {
            return back();
        } else {
            return back()->with("failed", "Failed! Itineraries not created");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $content = ItineraryEditor::where('content_details_tab_and_itinerary_general_info_tab_id',$id)->get();
        $content_rooms_tabs = ContentRoomTab::where('content_details_tabs_id','=',$id)->get()->first();
        $content_details_tabs = ContentDetailTab::where('id','=',$id)->get()->first();
        $content_type = ContentType::where('id','=',$content_details_tabs->content_type_id)->get()->first();
        $countries = Country::all();
        

        return view('content_pages.edit', [
            'content_details_tabs'=>$content_details_tabs,
            'content_type'=>$content_type,
            'countries'=>$countries,
            'content_rooms_tabs'=>$content_rooms_tabs,
            'content' => $content,
        ]);
        // $media = Media::find($id);
        // $tag = Tag::find($id);
        // return response()->json([
        //     'status'=>200,
        //     'media'=>$media,
        // ]);
    }
    public function editor($id)
    {
        //
        $content = ItineraryEditor::where('content_details_tab_and_itinerary_general_info_tab_id',$id)->get();
        $content_rooms_tabs = ContentRoomTab::where('id','=',$id)->get()->first();
        $content_details_tabs = ContentDetailTab::where('id','=',$content_rooms_tabs->content_details_tabs_id)->get()->first();
        $content_type = ContentType::where('id','=',$content_details_tabs->content_type_id)->get()->first();
        $countries = Country::all();
        return view('content_pages.edit', [
            'content_details_tabs'=>$content_details_tabs,
            'content_type'=>$content_type,
            'countries'=>$countries,
            'content_rooms_tabs'=>$content_rooms_tabs,
            'content' => $content,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        //
        $editor = ItineraryEditor::find($id);
        $editor->title = $request->title;
        $editor->description = $request->description;
        $editor->html_entities = htmlspecialchars($request->description);
        $editor->update();
        if ($editor) {
            //return redirect()->route('rich_text_editor.create')->with("success", "Success! Itineraries updated");
            //return redirect()->route('library/content')->withStatus('Content Pages Updated!!!');
            return redirect()->back()->with("success", "Success! Itineraries updated");
        } else {
            return back()->with("failed", "Failed! Itineraries not updated");
        }
    }
    /**
     * Upload image
     * @param request
     * @param response
     */
    public function uploadImage(Request $request)
    {
        if($request->hasFile('upload')) {
            //get filename with extension
            $filenamewithextension = $request->file('upload')->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file extension
            $extension = $request->file('upload')->getClientOriginalExtension();

            //filename to store
            $filenametostore = $filename.'_'.time().'.'.$extension;

            //Upload File
            $request->file('upload')->move('public/upload', $filenametostore);

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('public/upload/'.$filenametostore);
            $message = 'File uploaded successfully';
            $result = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$message')</script>";

            // Render HTML output
            @header('Content-type: text/html; charset=utf-8');
            echo $result;
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $editor = ItineraryEditor::find($id);
        $editor->delete();

      
        if ($editor) {
            $content_details_tabs = DB::table('content_details_tabs')
            ->join('itinerary_editors', 'content_details_tabs.id', '=', 'itinerary_editors.content_details_tab_and_itinerary_general_info_tab_id')
            ->select('content_details_tabs.id')
            ->where('itinerary_editors.id', $id)
            ->get()
            ->first();
            return redirect()->route('content_pages.edit',$content_details_tabs->id)->withStatus('Content Pages Deleted!!!');
            //return redirect()->route('library/content/pages',$content_details_tabs->id)->with("success", "Success! Itineraries deleted");
        } else {
            return redirect()->route('library/content/pages',$content_details_tabs->id)->with("failed", "Failed! Itineraries not deleted");
        }
    }
}
