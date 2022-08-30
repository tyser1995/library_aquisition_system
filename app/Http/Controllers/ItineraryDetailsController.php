<?php

namespace App\Http\Controllers;

use App\Models\ItineraryDetails;
use App\Models\ItineraryCosts;
use App\Models\ItineraryGeneralInfoTab;
use Illuminate\Http\Request;

class ItineraryDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $ItineraryDetails = new ItineraryDetails;
        $ItineraryGeneralInfoTab = ItineraryGeneralInfoTab::where('id','=',$request->id)->get()->first();
        return view('itineraries_details.create',
        [
            'ItineraryDetails'=>$ItineraryDetails,
            'ItineraryGeneralInfoTab' => $ItineraryGeneralInfoTab,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, ItineraryDetails $ItineraryDetails)
    {
        if($request->isMethod('post')){
            foreach($request->addfield_content_tag as $key => $addfield_content_tag ){
                 $ItineraryDetails = new ItineraryDetails;
                 $ItineraryDetails->itinerary_general_info_tabs_id = $request->input('itinerary_general_info_tabs_id');
                $ItineraryDetails->itinerary_details_addfield_activities = $request->addfield_date_activities[$key];
                $ItineraryDetails->itinerary_details_organize_by_days = $request->itinerary_details_organize_by_days[$key];
                $ItineraryDetails->addfield_input_date = $request->addfield_input_date_1[$key];
                $ItineraryDetails->itinerary_details_addfield_accommodations = $request->addfield_date_accommodations[$key];
                $ItineraryDetails->itinerary_contenttype = $request->addfield_content_tag[$key];
                $ItineraryDetails->addfield_date_from = $request->addfield_date_from[$key];
                $ItineraryDetails->addfield_date_to =$request->addfield_date_to[$key];
                 $ItineraryDetails->save();
            }


            // $addfield_organize_by_days = ($request->input('itinerary_details_organize_by_days'));
            // $addfield_date_activities = ($request->input('addfield_date_activities'));
            // $addfield_date_accommodations = ($request->input('addfield_date_accommodations'));
            // $addfield_date_from = ($request->input('addfield_date_from'));
            // $addfield_date_to = ($request->input('addfield_date_to'));
            // $addfield_input_date = ($request->input('addfield_input_date_1'));
            // $addfield_content_tags = ($request->input('addfield_content_tag'));
            // $ItineraryDetails->itinerary_general_info_tabs_id = $request->input('itinerary_general_info_tabs_id');
            //     $ItineraryDetails->itinerary_details_addfield_activities = implode(',', $addfield_date_activities);
            //     $ItineraryDetails->itinerary_details_organize_by_days = implode(',',$addfield_organize_by_days);
            //     $ItineraryDetails->addfield_input_date = implode(',',$addfield_input_date);
            //     $ItineraryDetails->itinerary_details_addfield_accommodations = implode(',',$addfield_date_accommodations);
            //     $ItineraryDetails->itinerary_contenttype = implode(',',  $addfield_content_tags);
            //     $ItineraryDetails->addfield_date_from = implode(',',$addfield_date_from);
            //     $ItineraryDetails->addfield_date_to = implode(',',$addfield_date_to);



            return redirect()->route('itinerary_costs.create',[
                'id' => $request->input('itinerary_general_info_tabs_id'),
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ItineraryDetails  $itineraryDetails
     * @return \Illuminate\Http\Response
     */
    public function show(ItineraryDetails $itineraryDetails)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ItineraryDetails  $itineraryDetails
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $ItineraryDetails = ItineraryDetails::where('itinerary_general_info_tabs_id', $id)->get();
        // $addfield_date_activities_array         = explode("," ,$ItineraryDetails->itinerary_details_addfield_activities);
        // $addfield_organize_by_days_array        = explode("," ,$ItineraryDetails->itinerary_details_organize_by_days);
        // $addfield_date_accommodations_array     = explode("," ,$ItineraryDetails->itinerary_details_addfield_accommodations);
        // $addfield_input_date_array              = explode("," ,$ItineraryDetails->addfield_input_date);
        // $addfield_date_from_array               = explode("," ,$ItineraryDetails->addfield_date_from);
        // $addfield_date_to_array                 = explode("," ,$ItineraryDetails->addfield_date_to);

        // $ItineraryGeneralInfoTab = ItineraryGeneralInfoTab::where('id',$ItineraryDetails->itinerary_general_info_tabs_id)->get()->first();
        // $ItineraryCosts = ItineraryCosts::where('itinerary_general_info_tabs_id',$ItineraryDetails->itinerary_general_info_tabs_id)->get()->first();

        // if(!$ItineraryCosts){
        //     $ItineraryCosts = new ItineraryCosts;
        //     $ItineraryCosts->itinerary_general_info_tabs_id = $ItineraryDetails->itinerary_general_info_tabs_id;
        //     $ItineraryCosts->save();
        // }


        return view('itineraries_details.edit',
        [
            'ItineraryDetails' => $ItineraryDetails,
            'id'                => $id,
            // 'addfield_date_activities_array' => $addfield_date_activities_array,
            // 'addfield_organize_by_days_array' => $addfield_organize_by_days_array,
            // 'addfield_input_date_array'       => $addfield_input_date_array,
            // 'addfield_date_accommodations_array' => $addfield_date_accommodations_array,
            // 'addfield_date_from_array' => $addfield_date_from_array,
            // 'addfield_date_to_array' => $addfield_date_to_array,
            // 'ItineraryCosts' => $ItineraryCosts,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ItineraryDetails  $itineraryDetails
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $ItineraryDetails = ItineraryDetails::find($id);
        $ItineraryGeneralInfoTab = ItineraryGeneralInfoTab::where('id','=',$id)->get()->first();
        $ItineraryCosts = ItineraryCosts::where('itinerary_general_info_tabs_id','=',$id)->get()->first();
        // $ItineraryDetails->itinerary_details_addfield_activities        = ($request->input('addfield_date_activities'));
        // $ItineraryDetails->itinerary_details_organize_by_days           = ($request->input('itinerary_details_organize_by_days'));
        // $ItineraryDetails->itinerary_details_addfield_accommodations    = ($request->input('addfield_date_accommodations'));
        // $ItineraryDetails->addfield_input_date                          = ($request->input('addfield_input_date_1'));
        // $ItineraryDetails->addfield_date_from                           = ($request->input('addfield_date_from'));
        // $ItineraryDetails->addfield_date_to                             = ($request->input('addfield_date_to'));

        // $ItineraryDetails->update();
        return redirect()->route('itinerary_costs.edit',$ItineraryCosts->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ItineraryDetails  $itineraryDetails
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItineraryDetails $itineraryDetails)
    {
        //
    }
}

