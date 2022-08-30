<?php

namespace App\Http\Controllers;

use App\Models\SafariPortalItineraries;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Arr;
// use Prezly\DraftPhp\Constants\BlockType;
// use Prezly\DraftPhp\Converter;
// use Prezly\DraftPhp\Model\ContentBlock;
// use Prezly\DraftPhp\Model\ContentState;
// use Prezly\DraftPhp\Model\EntityInstance;
use stdClass;

class SafariPortalItinerariesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('safari_portal.index');
    }

    public function data(){
        // $token = 'Basic '.base64_encode('jason@wayfairertravel.com:hzEk8jS5SspNApF9x4ODvSELv/g=');
        // $response = Http::withHeaders([
        //     'Authorization' => $token,
        //     'Content-Type' => 'application/json',
        // ])->get('https://api.safariportal.app/external_api/v1/acc/501882855006143972/itineraries/512165231443576082');

        $safari_portal_itineraries = SafariPortalItineraries::all();
        return response()->json([
            'data' => $safari_portal_itineraries,
        ]);
    }

    public function view($id){
        // $token = 'Basic '.base64_encode('jason@wayfairertravel.com:hzEk8jS5SspNApF9x4ODvSELv/g=');
        // $response = Http::withHeaders([
        //     'Authorization' => $token,
        //     'Content-Type' => 'application/json',
        // ])->get('https://api.safariportal.app/external_api/v1/acc/501882855006143972/itineraries/512165231443576082');

        
        // $collection = collect($response->json());
        // $data = $collection->map(function ($value, $key) {
        //     return $value;
        // });
        
        $get_data = DB::select('select * from phoenix.safari_portal_itineraries WHERE itinerary_id = ?', [$id]);
        $pages = json_decode(html_entity_decode($get_data[0]->landing),true)['pages'];
        $main_data = json_decode(json_encode($get_data),true)[0];
        //$landing = json_decode($main_data['landing'],true);
        $pages = json_decode($main_data['landing'],true)['pages'];
        $schedules = json_decode($main_data['schedules'],true);
        $way = json_decode($main_data['way'],true);
        $costs_details = "";
        $object = new stdClass();
        foreach($main_data as $key_main_data => $value_main_data){
            // echo $key_main_data.' : '.$value_main_data.'<br>';
            if($key_main_data == 'landing'){
                foreach($pages as $key_pages => $value_pages){
                    // echo $value_pages['headline'].'<br>';
                    foreach($value_pages['blocks'] as $key_page_blocks => $value_page_blocks){
                        //echo $value_page_blocks['type'].'<br>';
                    }
                }
            }

            if($key_main_data == 'schedules'){
               foreach(json_decode($value_main_data,true) as $key_schedules => $value_schedules){ //key pages, details
                    foreach($value_schedules['dates_range'] as $key_dates_range => $value_dates_range){
                        if(!is_null($value_dates_range))
                        {
                            //echo json_encode($value_dates_range).'<br>';
                        }
                            
                    }
                    foreach($value_schedules['details'] as $key_details => $value_details){
                        if(!empty($value_details['blocks'])){
                           foreach($value_details['blocks'] as $key_blocks => $value_blocks){
                               //echo $value_blocks['text'].'<br>';
                           }
                        }
                    }
                }
            }

            if($key_main_data == "costs"){
                $costs_details = json_decode($value_main_data,true);
                //echo json_decode(json_encode($value_main_data),true).'<br>';
                foreach(json_decode($value_main_data,true) as $key_costs => $value_costs){
                    if(is_array($value_costs)){
                        foreach($value_costs as $key_array => $value_array){
                            //echo json_encode($value_array).'<br>';
                        }
                    }else{
                        array_push($costs_details,$key_costs,$value_costs);
                        // echo 
                    }
                    
                }
            }
        }
        // $contentState = \Prezly\DraftPhp\Converter::convertFromJson($get_data);
        // return view('layouts.guest_itinerary',[
        //     'data' => json_decode(json_encode($get_data),true),
        //     'landings' => json_decode(json_encode($get_data),true)[0]['landing'],
        //     'get_data' => $get_data[0],
        //     'pages' => json_decode(html_entity_decode($get_data[0]->landing),true)['pages'],
        //     'schedules' => $schedules,
        // ]);
        return view('safari_portal.view',[
            'data' => json_decode(json_encode($get_data),true),
            'landings' => json_decode(json_encode($get_data),true)[0]['landing'],
            'get_data' => $get_data[0],
            'pages' => json_decode(html_entity_decode($get_data[0]->landing),true)['pages'],
            'schedules' => $schedules,
            'costs_details' => $costs_details,
            'way' => $way,
        ]);

        return response()->json([
            'data' => $get_data,
        ]);
    }

    public function view_react($id){
        $token = 'Basic '.base64_encode('jason@wayfairertravel.com:KAO7DNNCEpvSuCVRGC4ET+MVX1g=');
        $response = Http::withHeaders([
            'Authorization' => $token,
            'Content-Type' => 'application/json',
        ])->get('https://api.safariportal.app/external_api/v1/acc/501882855006143972/itineraries/512165231443576082');

        return response()->json([
            'data' => $response->json(),
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
        return view('safari_portal.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $token = 'Basic '.base64_encode('jason@wayfairertravel.com:KAO7DNNCEpvSuCVRGC4ET+MVX1g=');
        $response = Http::withHeaders([
            'Authorization' => $token,
            'Content-Type' => 'application/json',
        ])->get('https://api.safariportal.app/external_api/v1/acc/501882855006143972/itineraries/'.$request->itinerary_id);


        $data =$response->json();
        //
        $safari_portal_itineraries = new SafariPortalItineraries();
        $safari_portal_itineraries->itinerary_id = $data['id'];
        $safari_portal_itineraries->about_safari_pages = $data['about_safari_pages'];
        $safari_portal_itineraries->about_us_pages = $data['about_us_pages'];
        $safari_portal_itineraries->account = $data['account'];
        $safari_portal_itineraries->approved = $data['approved'];
        $safari_portal_itineraries->brand_settings = $data['brand_settings'];
        $safari_portal_itineraries->confirmed = $data['confirmed'];
        $safari_portal_itineraries->costs = $data['costs'];
        $safari_portal_itineraries->costs_accept = $data['costs_accept'];
        $safari_portal_itineraries->creator = $data['creator'];
        $safari_portal_itineraries->current_step = $data['current_step'];
        $safari_portal_itineraries->custom_fonts = $data['custom_fonts'];
        $safari_portal_itineraries->custom_styles = $data['custom_styles'];
        $safari_portal_itineraries->emergency_contacts = $data['emergency_contacts'];
        $safari_portal_itineraries->first_viewed = $data['first_viewed'];
        $safari_portal_itineraries->guest_portal_last_available_step = $data['guest_portal_last_available_step'];
        $safari_portal_itineraries->landing = $data['landing'];
        $safari_portal_itineraries->last_available_step = $data['last_available_step'];
        $safari_portal_itineraries->misc_pages = $data['misc_pages'];
        $safari_portal_itineraries->notes = $data['notes'];
        $safari_portal_itineraries->original_id = $data['original_id'];
        $safari_portal_itineraries->persona_bank = $data['persona_bank'];
        $safari_portal_itineraries->persona_bank_id = $data['persona_bank_id'];
        $safari_portal_itineraries->prepared_for = $data['prepared_for'];
        $safari_portal_itineraries->schedule_type = $data['schedule_type'];
        $safari_portal_itineraries->schedules = $data['schedules'];
        $safari_portal_itineraries->share_url = $data['share_url'];
        $safari_portal_itineraries->shared = $data['shared'];
        $safari_portal_itineraries->subscriptions = $data['subscriptions'];
        $safari_portal_itineraries->tags = $data['tags'];
        $safari_portal_itineraries->title = $data['title'];
        $safari_portal_itineraries->tour_request = $data['tour_request'];
        $safari_portal_itineraries->tour_request_id = $data['tour_request_id'];
        $safari_portal_itineraries->travel_dates = $data['travel_dates'];
        $safari_portal_itineraries->travel_end_date = $data['travel_end_date'];
        $safari_portal_itineraries->travel_start_date = $data['travel_start_date'];
        $safari_portal_itineraries->type = $data['type'];
        $safari_portal_itineraries->way = $data['way'];
        $safari_portal_itineraries->white_labeling_on = $data['white_labeling_on'];

        $results = DB::select('select * from safari_portal_itineraries where itinerary_id = :id', ['id' => $data['id']]);
        if(count($results) > 0) {
            //$safari_portal_itineraries->update();
            return back()->with("success", "Safari Portal Itinerary ID has already added");
        } else {
            $safari_portal_itineraries->save();
            return redirect()->route('safari_portal_itineraries.index')->with('success', 'Safari Portal Itinerary has been added');
        }

        return response()->json([
            'data' => [$response->json()],
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SafariPortalItineraries  $safariPortalItineraries
     * @return \Illuminate\Http\Response
     */
    public function show(SafariPortalItineraries $safariPortalItineraries)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SafariPortalItineraries  $safariPortalItineraries
     * @return \Illuminate\Http\Response
     */
    public function edit(SafariPortalItineraries $safariPortalItineraries)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SafariPortalItineraries  $safariPortalItineraries
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SafariPortalItineraries $safariPortalItineraries)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SafariPortalItineraries  $safariPortalItineraries
     * @return \Illuminate\Http\Response
     */
    public function destroy(SafariPortalItineraries $safariPortalItineraries)
    {
        //
    }

    public function new_itinerary(){
        return view('safari_portal.create_itinerary');
    } 
}
