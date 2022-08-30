<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContentDetail;
use App\Models\ContentType;
use App\Models\Country;
use App\Models\ContentDetailTab;
use App\Models\ContentRoomTab;
use App\Models\ContentPage;
use App\Models\Media;
use App\Models\ItineraryEditor;
use Illuminate\Support\Facades\Auth;

class ContentRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
        $content_type = ContentType::find($id);
        $countries = Country::all();        
        $contentDetailTab = ContentDetailTab::where('content_type_id',$content_type->id)->get();
        return view('content_rooms.index',[
            'content_type'=>$content_type,
            'countries' => $countries,
            'content_details_tabs' => $contentDetailTab,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $contentDetailTab = ContentDetailTab::orderBy('created_at','DESC')->get()->first();

        $contentRoomTab = new ContentRoomTab();
        $content_type = ContentType::find($contentDetailTab->content_type_id);
        $countries = Country::all();
        $media = Media::all();
        //reference id
        $contentRoomTab -> content_details_tabs_id = $contentDetailTab->id;
        $contentRoomTab -> created_by_user_id = $contentDetailTab->created_by_user_id;
        $contentRoomTab -> content_type_id = $contentDetailTab->content_type_id;
        $contentRoomTab -> property_name = $contentDetailTab->property_name;
        $contentRoomTab -> contries = $contentDetailTab->countries;

        $contentRoomTab -> room_type = $request->input('room_type');
        $contentRoomTab -> room_desc = $request->input('room_desc');
        
        //dynamic fields <starts>
        $contentRoomTab -> vid_name = implode(',',$request->input('vid_name'));
        $contentRoomTab -> vid_link = implode(',',$request->input('vid_link'));
        //dynamic fields <ends>

        $contentRoomTab->save();

        $content = ItineraryEditor::where('content_details_tab_and_itinerary_general_info_tab_id',$contentDetailTab->id)->get();

        if($content_type->hasPages == 1){
            return redirect()->route('library/content/pages',$request->content_type_id);
            // return view('content_pages.index',[
            //     'content_type'=>$content_type,
            //     'countries' => $countries,
            //     'content_details_tabs' => $contentDetailTab,
            //     'content_rooms_tabs' => $contentRoomTab,
            //     'media' => $media,
            //     'content' => $content,
            // ]);
        }else{
            return redirect()->route('library/content')->withStatus('Content Pages Created!!!');
        }
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
        
        $content_rooms_tabs = ContentRoomTab::where('id','=',$id)->get()->first();
        $content_details_tabs = ContentDetailTab::where('id','=',$content_rooms_tabs->content_details_tabs_id)->get()->first();
        $content_type = ContentType::where('id','=',$content_details_tabs->content_type_id)->get()->first();
        $countries = Country::all();
        
        return view('content_rooms.edit', [
            'content_details_tabs'=>$content_details_tabs,
            'content_type'=>$content_type,
            'countries'=>$countries,
            'content_rooms_tabs'=>$content_rooms_tabs
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $content_rooms_tabs = ContentRoomTab::findOrfail($id);

        $content_rooms_tabs -> room_type = $request->input('room_type');
        $content_rooms_tabs -> room_desc = $request->input('room_desc');
        
        //dynamic fields <starts>
        $content_rooms_tabs -> vid_name = implode(',',$request->input('vid_name'));
        $content_rooms_tabs -> vid_link = implode(',',$request->input('vid_link'));
        //dynamic fields <ends>

        $content_rooms_tabs->update();

        //
        $contentDetailTab = ContentDetailTab::orderBy('created_at','DESC')->get()->first();
        $content_type = ContentType::find($contentDetailTab->content_type_id);
        $contentPagesTab = ContentPage::where('content_details_tabs_id','=',$contentDetailTab->id)->get()->first();
        $content = ItineraryEditor::where('content_details_tab_and_itinerary_general_info_tab_id',$content_rooms_tabs->content_details_tabs_id)->get();

        if($content_type->hasPages == 1){
            return redirect()->route('content_pages.edit',$content_rooms_tabs->content_details_tabs_id);
        }else{
            return redirect()->route('library/content')->withStatus('Content Pages Created!!!');
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
    }
}
