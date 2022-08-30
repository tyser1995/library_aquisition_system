<?php

namespace App\Http\Controllers;

use App\Models\ItineraryGeneralInfoTab;
use App\Models\ItineraryDetails;
use App\Models\ItineraryCosts;
use App\Models\Itinerary;
use App\Models\User;
use Illuminate\Http\Request;

class ItineraryGeneralInfoController extends Controller
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
    public function create()
    {

        return view('itineraries_general_info.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,ItineraryGeneralInfoTab $model)
    {
        if($request->isMethod('post')){

            $ItineraryGeneralInfoTabs = new ItineraryGeneralInfoTab;
            $ItineraryGeneralInfoTabs->itinerary_types_id = 1;
            $ItineraryGeneralInfoTabs->itinerary_geninfo_file_name = ucfirst($request->input('itinerary_geninfo_file_name'));
            $ItineraryGeneralInfoTabs->itinerary_geninfo_prepared_for = ucfirst($request->input('itinerary_geninfo_prepared_for'));
            $ItineraryGeneralInfoTabs->itinerary_geninfo_proposal_travel_dates = ucfirst($request->input('itinerary_geninfo_proposal_travel_dates'));
            $ItineraryGeneralInfoTabs->itinerary_geninfo_notes = ucfirst($request->input('itinerary_geninfo_notes'));
            $ItineraryGeneralInfoTabs->itinerary_geninfo_proposal_title = ucfirst($request->input('itinerary_geninfo_proposal_title'));
            $ItineraryGeneralInfoTabs->itinerary_geninfo_about_us = ucfirst($request->input('itinerary_geninfo_about_us'));
            $ItineraryGeneralInfoTabs->itinerary_geninfo_note_about_safari = ucfirst($request->input('itinerary_geninfo_note_about_safari'));
            $ItineraryGeneralInfoTabs->itinerary_geninfo_TC = ucfirst($request->input('itinerary_geninfo_TC'));
            $ItineraryGeneralInfoTabs->itinerary_geninfo_label_branding = ucfirst($request->input('itinerary_geninfo_label_branding'));
            $ItineraryGeneralInfoTabs->description = 'Create';

            $ItineraryGeneralInfoTabs->save();

            //INSERT itinerary_general_info_tabs_id to itinerary_details
            // $ItineraryDetails = new ItineraryDetails();
            // $ItineraryDetails->itinerary_general_info_tabs_id = ItineraryGeneralInfoTab::max('id');
            // $ItineraryDetails->save();


            return redirect()->route('itinerary_details.create',[
                'id' => $ItineraryGeneralInfoTabs->id,
            ]);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ItineraryGeneralInfo  $itineraryGeneralInfo
     * @return \Illuminate\Http\Response
     */
    public function show(ItineraryGeneralInfo $itineraryGeneralInfo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ItineraryGeneralInfo  $itineraryGeneralInfo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ItineraryGeneralInfoTab = ItineraryGeneralInfoTab::where('id','=',$id)->get()->first();
        return view('itineraries_general_info.edit',
        [
            'ItineraryGeneralInfoTab' => $ItineraryGeneralInfoTab,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ItineraryGeneralInfo  $itineraryGeneralInfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $ItineraryGeneralInfoTabs = new ItineraryGeneralInfoTab;
        $ItineraryGeneralInfoTabs = ItineraryGeneralInfoTab::find($id);
        $ItineraryDetails = ItineraryDetails::where('itinerary_general_info_tabs_id', $id)->get()->first();
        $ItineraryGeneralInfoTabs->itinerary_geninfo_file_name    = ($request->input('itinerary_geninfo_file_name'));
        $ItineraryGeneralInfoTabs->itinerary_geninfo_prepared_for     = ($request->input('itinerary_geninfo_prepared_for'));
        $ItineraryGeneralInfoTabs->itinerary_geninfo_proposal_travel_dates    = ($request->input('itinerary_geninfo_proposal_travel_dates'));
        $ItineraryGeneralInfoTabs->itinerary_geninfo_notes    = ($request->input('itinerary_geninfo_notes'));
        $ItineraryGeneralInfoTabs->itinerary_geninfo_proposal_title    = ($request->input('itinerary_geninfo_proposal_title'));
        $ItineraryGeneralInfoTabs->itinerary_geninfo_about_us    = ($request->input('itinerary_geninfo_about_us'));
        $ItineraryGeneralInfoTabs->itinerary_geninfo_note_about_safari   = ($request->input('itinerary_geninfo_note_about_safari'));
        $ItineraryGeneralInfoTabs->itinerary_geninfo_TC    = ($request->input('itinerary_geninfo_TC'));
        $ItineraryGeneralInfoTabs->itinerary_geninfo_label_branding   = ($request->input('itinerary_geninfo_label_branding'));

        $ItineraryGeneralInfoTabs->update();

        $ItineraryCosts = ItineraryCosts::where('itinerary_general_info_tabs_id',$id)->get()->first();


        return redirect()->route('itinerary_details.edit',$id );
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ItineraryGeneralInfo  $itineraryGeneralInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItineraryGeneralInfo $itineraryGeneralInfo)
    {
        //
    }
}
