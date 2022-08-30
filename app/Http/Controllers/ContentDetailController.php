<?php

namespace App\Http\Controllers;

use App\Models\ContentDetail;
use App\Models\ContentType;
use App\Models\Country;
use App\Models\ContentDetailTab;
use App\Models\ContentRoomTab;
use App\Models\ContentPage;
use App\Models\Media;
use App\Models\ItineraryEditor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ContentDetailController extends Controller
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
        $contentDetailTab = ContentDetailTab::find($content_type->id);

        return view('content_details.index',[
            'content_type'=>$content_type,
            'countries' => $countries,
            'content_details_tabs' => $contentDetailTab
        ]);
            
        return response()->json([
            'status'=>200,
            'content_type'=>$content_type,
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
        
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $contentDetailTab = new ContentDetailTab();
        $content_type = ContentType::find($request -> content_type_id);
        $countries = Country::all();
        //get country name
        $get_country_name = Country::where('id','=',$request -> country_id)->get()->first();
        
        $contentDetailTab ->    property_name = $request->input('property_name');
        $contentDetailTab ->    tag_name = $request->input('tag_name');
        $contentDetailTab ->    created_by_user_id = Auth::user()->id;
        $contentDetailTab ->    content_type_id = $request -> content_type_id;
        $contentDetailTab ->    countries = $get_country_name->country_name;

        //dynamic fields <starts>
        $contentDetailTab ->    ec_type_of_contact = implode(',', $request->input('ec_type_of_contact'));
        $contentDetailTab ->    ec_name = implode(',', $request -> input('ec_name'));
        $contentDetailTab ->    ec_phone_number = implode(',', $request-> input('ec_phone_number'));
        $contentDetailTab ->    ec_email = implode(',', $request->input('ec_email'));
        $contentDetailTab ->    office_type_of_contact = implode(',', $request->input('office_type_of_contact'));
        $contentDetailTab ->    office_name = implode(',', $request->input('office_name'));
        $contentDetailTab ->    office_phone_number = implode(',', $request->input('office_phone_number'));
        $contentDetailTab ->    office_email = implode(',', $request->input('office_email'));
        //dynamic fields <ends>
        $contentDetailTab ->    address = $request -> input('address');
        $contentDetailTab ->    coordinates = $request -> input('coordinates');
        $contentDetailTab->save();
        
        $contentDetailTabAll = ContentDetailTab::all();
        if($content_type->hasRooms == 1){
            return redirect()->route('library/content/rooms',$request -> content_type_id);
            // return view('content_rooms.index',[
            //     'content_type'=>$content_type,
            //     'countries' => $countries,
            //     'content_details_tabs' => $contentDetailTabAll,
            // ]);
        }else if($content_type->hasPages == 1){
            return redirect()->route('library/content/pages',$request -> content_type_id);
            // return view('content_pages.index',[
            //     'content_type'=>$content_type,
            //     'countries' => $countries,
            //     'content_details_tabs' => $contentDetailTabAll,
            //     'media' =>$media,
            // ]);
        }else{
            return redirect()->route('library/content')->withStatus('Content Pages Created!!!');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ContentDetail  $contentDetail
     * @return \Illuminate\Http\Response
     */
    // public function show(ContentDetail $contentDetail)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ContentDetail  $contentDetail
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $content_details_tabs = ContentDetailTab::findOrfail($id);
        $content_type = ContentType::find($content_details_tabs->content_type_id);
        $countries = Country::all();
        $content_rooms_tabs = ContentRoomTab::where('content_details_tabs_id','=',$id)->get()->first();
        $content_pages_tabs = ContentPage::where('content_details_tabs_id','=',$id)->get()->first();
        $content = ItineraryEditor::where('content_details_tab_and_itinerary_general_info_tab_id',$content_details_tabs->id)->get();

        if(is_null($content_pages_tabs)){
            //Insert temp
            $content_pages_tabs = new ContentPage;
            $content_pages_tabs->content_details_tabs_id = $content_details_tabs->id;
            $content_pages_tabs->media_id = $content_details_tabs->id;
            $content_pages_tabs->image = $content_details_tabs->id;
            $content_pages_tabs->detail_type = $content_details_tabs->id;
            $content_pages_tabs->order = $content_details_tabs->id;
            $content_pages_tabs->detail_name = $content_details_tabs->id;
            $content_pages_tabs->detail_value = $content_details_tabs->id;

            $content_pages_tabs->save();
        }

        if($content_type->hasRooms == 1){
            if(isset($content_rooms_tabs)){
                return view('content_details.edit', [
                    'content_details_tabs'=>$content_details_tabs,
                    'content_type'=>$content_type,
                    'countries'=>$countries,
                    'content_rooms_tabs'=>$content_rooms_tabs,
                    'content_pages_tabs'=>$content_pages_tabs,
                    'content'=>$content,
                ]);
            }else{
                //Insert temp
                $contentDetailTab = ContentDetailTab::orderBy('created_at','DESC')->get()->first();
                
                $contentRoomTab = new ContentRoomTab();
                $content_type = ContentType::all();
                $countries = Country::all();
                //reference id
                $contentRoomTab -> content_details_tabs_id = $contentDetailTab->id;
                $contentRoomTab -> created_by_user_id = $contentDetailTab->created_by_user_id;
                $contentRoomTab -> content_type_id = $contentDetailTab->content_type_id;
                $contentRoomTab -> property_name = $contentDetailTab->property_name;
                $contentRoomTab -> contries = $contentDetailTab->countries;
    
                $contentRoomTab->save();

                //
                return view('content_details.edit', [
                    'content_details_tabs'=>$content_details_tabs,
                    'content_type'=>$content_type,
                    'countries'=>$countries,
                    'content_rooms_tabs'=>$content_rooms_tabs,
                    'content_pages_tabs'=>$content_pages_tabs,
                    'content'=>$content,
                ]);
            }
        }else if($content_type->hasPages == 1){
            if(isset($content_pages_tabs)){
                return view('content_details.edit', [
                    'content_details_tabs'=>$content_details_tabs,
                    'content_type'=>$content_type,
                    'countries'=>$countries,
                    'content_pages_tabs'=>$content_pages_tabs,
                    'content'=>$content,
                ]);
            }else{
                return view('content_details.edit', [
                    'content_details_tabs'=>$content_details_tabs,
                    'content_type'=>$content_type,
                    'countries'=>$countries,
                    'content_pages_tabs'=>$content_pages_tabs,
                    'content'=>$content,
                ]);
            }
        }
        
        
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ContentDetail  $contentDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        //
        $contentDetailTab = ContentDetailTab::findOrfail($id);
        $content_type = ContentType::find($request->content_type_id);
        $countries = Country::all();
       
        //get country name
        $get_country_name = Country::where('id','=',$request -> country_id)->get()->first();
        
        $contentDetailTab ->    property_name = $request->input('property_name');
        $contentDetailTab ->    tag_name = $request->input('tag_name');
        $contentDetailTab ->    created_by_user_id = Auth::user()->id;
        $contentDetailTab ->    content_type_id = $request -> content_type_id;
        $contentDetailTab ->    countries = $get_country_name->country_name;

        //dynamic fields <starts>
        $contentDetailTab ->    ec_type_of_contact = implode(',', $request->input('ec_type_of_contact'));
        $contentDetailTab ->    ec_name = implode(',', $request -> input('ec_name'));
        $contentDetailTab ->    ec_phone_number = implode(',', $request-> input('ec_phone_number'));
        $contentDetailTab ->    ec_email = implode(',', $request->input('ec_email'));
        $contentDetailTab ->    office_type_of_contact = implode(',', $request->input('office_type_of_contact'));
        $contentDetailTab ->    office_name = implode(',', $request->input('office_name'));
        $contentDetailTab ->    office_phone_number = implode(',', $request->input('office_phone_number'));
        $contentDetailTab ->    office_email = implode(',', $request->input('office_email'));
        // //dynamic fields <ends>
        $contentDetailTab ->    address = $request -> input('address');
        $contentDetailTab ->    coordinates = $request -> input('coordinates');

        $contentDetailTab->update();

        $contentRoomTab = ContentRoomTab::where('content_details_tabs_id','=',$contentDetailTab->id)->get()->first();
        $contentPagesTab = ContentPage::where('content_details_tabs_id','=',$contentDetailTab->id)->get()->first();
        if($content_type->hasRooms == 1)
            return redirect()->route('content_rooms.edit',$contentRoomTab);
        else if($content_type->hasPages == 1)
            return redirect()->route('content_pages.edit',$contentPagesTab);
        else
            return redirect()->route('library/content')->withStatus('Content Pages Updated!!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ContentDetail  $contentDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $content_details_tabs = ContentDetailTab::find($id);
        $content_details_tabs->delete();
        return redirect()->route('library/content')->withStatus(__('Content Pages deleted'));
    }
}