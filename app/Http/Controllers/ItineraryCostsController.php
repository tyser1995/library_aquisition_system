<?php

namespace App\Http\Controllers;

use App\Models\ItineraryCosts;
use App\Models\ItineraryDetails;
use App\Models\ItineraryGeneralInfoTab;
use App\Models\ContentPageEditor;
use Illuminate\Http\Request;

class ItineraryCostsController extends Controller
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
        //
        $ItineraryGeneralInfoTab = ItineraryGeneralInfoTab::where('id','=',$request->id)->get()->first();
        return view('itineraries_costs.create',[
            'ItineraryGeneralInfoTab'=>$ItineraryGeneralInfoTab,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, ItineraryCosts $ItineraryCosts)
    {
        if($request->isMethod('post'))
        {

            $ItineraryCosts = new ItineraryCosts;
            // dd($request->all());
            $ItineraryCosts->itinerary_costs_template = ($request->itinerary_costs_template);
            $ItineraryCosts->rooming_configuration_name = ($request->input_rooming_configuration);
            $ItineraryCosts->notes_name = ($request->input_costs_notes);
            $ItineraryCosts->costs_include_name = ($request->input_costs_cost_includes);
            $ItineraryCosts->costs_not_include_name = ($request->input_costs_cost_not_includes);
            $ItineraryCosts->itinerary_general_info_tabs_id = ($request->itinerary_general_info_tabs_id);
          
            $ItineraryCosts->save();

            return redirect()->route('itinerary_tab.create',[
                'id'=>$request->itinerary_general_info_tabs_id,
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ItineraryCosts  $itineraryCosts
     * @return \Illuminate\Http\Response
     */
    public function show(ItineraryCosts $ItineraryCosts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ItineraryCosts  $itineraryCosts
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ItineraryCosts = ItineraryCosts::find($id);
        $ItineraryGenInfo = ItineraryGeneralInfoTab::where('id',$ItineraryCosts->itinerary_general_info_tabs_id)->get()->first();
        $ItineraryDetails = ItineraryDetails::where('itinerary_general_info_tabs_id',$ItineraryCosts->itinerary_general_info_tabs_id)->get()->first();
        $cost = ItineraryCosts::where('id',$id)->get();


        // $content = ContentPageEditor::where('content_details_tabs_id',$ItineraryCosts->itinerary_general_info_tabs_id)->get();
        
        // // if(!$ContentPageEditor){
        // //     $ItineraryCosts = new ItineraryCosts;
        // //     $ItineraryCosts->itinerary_general_info_tabs_id = $ItineraryDetails->itinerary_general_info_tabs_id;
        // //     $ItineraryCosts->save();
        // // }

        return view('itineraries_costs.edit', [
            'ItineraryCosts' => $ItineraryCosts,
            'ItineraryGenInfo' => $ItineraryGenInfo,
            'ItineraryDetails' => $ItineraryDetails,
            'cost' => $cost,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ItineraryCosts  $itineraryCosts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $ItineraryCosts = ItineraryCosts::find($id);
        $ItineraryCosts->itinerary_costs_template = ($request->itinerary_costs_template);
        $ItineraryCosts->rooming_configuration_name = ($request->input_rooming_configuration);
        $ItineraryCosts->notes_name = ($request->input_costs_notes);
        $ItineraryCosts->costs_include_name = ($request->input_costs_cost_includes);
        $ItineraryCosts->costs_not_include_name = ($request->input_costs_cost_not_includes);
        $ItineraryCosts->update();
         
        $content = ContentPageEditor::where('content_details_tabs_id',$ItineraryCosts->itinerary_general_info_tabs_id)->get();
        return redirect()->route('itinerary_tab.edit', $ItineraryCosts->itinerary_general_info_tabs_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ItineraryCosts  $itineraryCosts
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItineraryCosts $itineraryCosts)
    {
        //
    }
}