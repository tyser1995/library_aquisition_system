<?php

namespace App\Http\Controllers;

use App\Models\Itinerary;
use App\Models\ItineraryGeneralInfoTab;
use App\Models\User;
use App\Models\ItinerarySendMail;
use App\Models\ItinerarySendMailAdded;
use App\Mail\ItineraryMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ItineraryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        
        $all_itinerary_types = Itinerary::orderBy('created_at','ASC')->get();
        $selected_itinerary_type = ($request->input('id') != "" ? Itinerary::findOrFail($request->input('id')) : Itinerary::take(1)->first() );
       
        $content_details_tabs_all = ItineraryGeneralInfoTab::where('itinerary_types_id','=',0)->orderBy('created_at','ASC')->get();
        $content_details_tabs_all->itinerary_types_id = $request->itinerary_types_id;
        // if($content_details_tabs_all->itinerary_types_id == 0){
        //     dd($user_all);
        // }
        return view('itineraries.index', [
            'all_itinerary_types' => $all_itinerary_types,
            'selected_itinerary_type' => $selected_itinerary_type,
            'content_details_tabs_all' => $content_details_tabs_all,
            'user_name' => Auth::user(),
        ]);
    }
    
    public function getItinerary(Request $request) 
    {   
        $all_itinerary_types = Itinerary::find($request->itinerary_types_id);
        $selected_itinerary_type = ($request->input('id') != "" ? Itinerary::findOrFail($request->input('id')) : Itinerary::take(1)->first() );
        $content_details_tabs_all = ItineraryGeneralInfoTab::where('itinerary_types_id','=',$request->itinerary_types_id)->orderBy('created_at','ASC')->get();
        
        
        return view('itineraries.get_contents',[
            'all_itinerary_types' => $all_itinerary_types,
            'content_details_tabs' => $content_details_tabs_all,
            'user_name' => Auth::user(),

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
        return view('itineraries.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Itinerary $model)
    {
        if($request->isMethod('post')){

            $Itinerary= new Itinerary;
            $user_all = new User;
            
            return redirect()->route('itineraries.index')->withStatus('Itineraries Confirmed!');
        
        }
    }

    public function sendMail(Request $request, ItinerarySendMailAdded $itinerary_send_mail_added)
    {
        if($request->isMethod('post')){

            $itinerary_send_mail = new ItinerarySendMail;
            $itinerary_send_mail->client_first_name = ($request->input('share_btn_client_fname'));
            $itinerary_send_mail->client_last_name = ($request->input('share_btn_client_lname'));
            $itinerary_send_mail->client_email = ($request->input('share_btn_client_email'));
            $itinerary_send_mail->agent_first_name = ($request->input('share_btn_agent_fname'));
            $itinerary_send_mail->agent_last_name = ($request->input('share_btn_agent_lname'));
            $itinerary_send_mail->agent_email = ($request->input('share_btn_agent_email'));
            $itinerary_send_mail->client_message = ($request->input('client_custom_message'));
            $itinerary_send_mail->agent_message = ($request->input('agent_custom_message'));


            /* Added inputs in Share Modal */
            $itinerary_send_mail_added = new ItinerarySendMailAdded;
            
            $added_input_fname_array = $request->input('share_btn_added_fname');
            $added_input_lname_array = $request->input('share_btn_added_lname');
            $added_input_email_array = $request->input('share_btn_added_email');
            $itinerary_send_mail_added->share_btn_added_input_client_message = ($request->input('client_custom_message'));
            $itinerary_send_mail_added->share_btn_added_input_agent_message = ($request->input('agent_custom_message'));

            $user_all = Auth::user();

            if($itinerary_send_mail->agent_email == null && $added_input_email_array == null){
                \Mail::to($itinerary_send_mail->client_email)->send(new ItineraryMail($itinerary_send_mail, $user_all));
            }elseif($itinerary_send_mail->client_email == null &&  $added_input_email_array == null){
                \Mail::to($itinerary_send_mail->agent_email)->send(new ItineraryMail($itinerary_send_mail, $user_all));
            }elseif($added_input_email_array !== null && $itinerary_send_mail->agent_email == null){

                $added_first_names = implode("," ,$added_input_fname_array);
                $itinerary_send_mail_added->share_btn_added_input_fname = $added_first_names;

                $added_last_names = implode("," ,$added_input_lname_array);
                $itinerary_send_mail_added->share_btn_added_input_lname = $added_last_names;

                $added_emails = implode(" " ,$added_input_email_array);
                $itinerary_send_mail_added->share_btn_added_input_email = $added_emails;

                $added_emails_explode = explode("  " , $itinerary_send_mail_added->share_btn_added_input_email); 

                \Mail::cc($added_emails)->send(new ItineraryMail($itinerary_send_mail_added, $user_all));
                \Mail::to($itinerary_send_mail->client_email)->send(new ItineraryMail($itinerary_send_mail, $user_all));
            }elseif($added_input_email_array !== null && $itinerary_send_mail->client_email == null){

                $added_first_names = implode("," ,$added_input_fname_array);
                $itinerary_send_mail_added->share_btn_added_input_fname = $added_first_names;

                $added_last_names = implode("," ,$added_input_lname_array);
                $itinerary_send_mail_added->share_btn_added_input_lname = $added_last_names;

                $added_emails = implode(" " ,$added_input_email_array);
                $itinerary_send_mail_added->share_btn_added_input_email = $added_emails;

                $added_emails_explode = explode("  " , $itinerary_send_mail_added->share_btn_added_input_email); 

                \Mail::cc($added_emails)->send(new ItineraryMail($itinerary_send_mail_added, $user_all));
                \Mail::to($itinerary_send_mail->agent_email)->send(new ItineraryMail($itinerary_send_mail, $user_all));
            }

            $itinerary_send_mail->save();
            $itinerary_send_mail_added->save();

            return redirect()->route('itineraries.index')->withStatus('Email Successfully Sent!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Itinerary  $itinerary
     * @return \Illuminate\Http\Response
     */
    public function show(Itinerary $itinerary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Itinerary  $itinerary
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ItineraryGeneralInfoTab = ItineraryGeneralInfoTab::findOrFail($id);
        return response()->json([
            'status'=>200,
            'ItineraryGeneralInfoTab'=>$ItineraryGeneralInfoTab
        ]);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Itinerary  $itinerary
     * @return \Illuminate\Http\Response
     */

    public function moveToPipeline(Request $request)
    { 
        
            $ItineraryGeneralInfoTabs = ItineraryGeneralInfoTab::findOrFail($request->itinerary_id_pipeline);
            $ItineraryGeneralInfoTabs->itinerary_types_id = 1;
            $ItineraryGeneralInfoTabs->itinerary_geninfo_proposal_title = ($request->input('itinerary_geninfo_proposal_title'));
        
        $ItineraryGeneralInfoTabs->save();

        return redirect()->route('itineraries.index')->withStatus('Itinerary Updated');
    }
    public function update(Request $request)
    { 
        
        if($request->itinerary_status == 'pipeline'){
            $ItineraryGeneralInfoTabs = ItineraryGeneralInfoTab::findOrFail($request->itinerary_id_pipeline);
            $user_all = new User;
            $ItineraryGeneralInfoTabs->itinerary_types_id = 1;
            $ItineraryGeneralInfoTabs->description = 'Update';
        }else if($request->itinerary_status == 'confirmed'){
            $ItineraryGeneralInfoTabs = ItineraryGeneralInfoTab::findOrFail($request->itinerary_id);
            $ItineraryGeneralInfoTabs->itinerary_types_id = 2;
            $ItineraryGeneralInfoTabs->number_of_guest     = ($request->input('number_of_guest'));
            $ItineraryGeneralInfoTabs->description = 'Update';
        }else if($request->itinerary_status == 'completed'){
            $ItineraryGeneralInfoTabs = ItineraryGeneralInfoTab::findOrFail($request->itinerary_id_completed);
            $ItineraryGeneralInfoTabs->itinerary_types_id = 3;
            $ItineraryGeneralInfoTabs->description = 'Update';
        }else if($request->itinerary_status == 'archived'){
            $ItineraryGeneralInfoTabs = ItineraryGeneralInfoTab::findOrFail($request->itinerary_id_archived);
            $ItineraryGeneralInfoTabs->itinerary_status_archived     = ($request->input('itinerary_status_archived'));
            $ItineraryGeneralInfoTabs->itinerary_types_id = 4;
            $ItineraryGeneralInfoTabs->description = 'Update';
        }
        $ItineraryGeneralInfoTabs->update();

        return redirect()->route('itineraries.index')->withStatus('Itinerary Updated');
    }
    public function addGuest(Request $request)
    { 
        // dd($request->all());
        $ItineraryGeneralInfoTabs = ItineraryGeneralInfoTab::findOrFail($request->itinerary_id);
        $ItineraryGeneralInfoTabs->itinerary_types_id = 2;
        $ItineraryGeneralInfoTabs->number_of_guest     = ($request->input('number_of_guest'));
        $ItineraryGeneralInfoTabs->update();
        
        return redirect()->route('itineraries.index')->withStatus('Itinerary Guest Added');
    }

    public function indexUpdateGuest(Request $request,ItineraryGeneralInfoTab $model)
    { 
      
        return redirect()->route('itineraries.updateGuest');
    }

    public function updateGuest(Request $request)
    { 
        // dd($request->all());
        if($request->itinerary_status == '1'){
            $ItineraryGeneralInfoTabs->itinerary_types_id = 1;
        }
        $ItineraryGeneralInfoTabs = ItineraryGeneralInfoTab::findOrFail($request->itinerary_id_update_guest);
        $ItineraryGeneralInfoTabs->number_of_guest     = ($request->input('number_of_guest'));
        $ItineraryGeneralInfoTabs->itinerary_geninfo_proposal_title = ($request->input('itinerary_geninfo_proposal_title'));
        $ItineraryGeneralInfoTabs->save();
        
        return redirect()->route('itineraries.index')->withStatus('Itinerary Guest Updated');
    }

    public function indexAltUser(Request $request,ItineraryGeneralInfoTab $model)
    { 
      
        return redirect()->route('itineraries.updateAltUser');
    }

    public function updateAltUser(Request $request)
    { 
       
        
        $ItineraryGeneralInfoTabs = ItineraryGeneralInfoTab::findOrFail($request->itinerary_id_alt_user);
        $ItineraryGeneralInfoTabs->itinerary_geninfo_prepared_for     = ($request->input('itinerary_geninfo_prepared_for'));
        
        $ItineraryGeneralInfoTabs->update();
        return redirect()->route('itineraries.index')->withStatus('Itinerary Guest Updated');
    }

    public function updateItinerary(Request $request,ItineraryGeneralInfoTab $ItineraryGeneralInfoTab)
    { 
        
        $ItineraryGeneralInfoTab = ItineraryGeneralInfoTab::find($request->input('itinerary_id_itinerary'));
        $ItineraryGeneralInfoTab->internal_file_notes     = ($request->input('td_internal_file_notes'));
        $ItineraryGeneralInfoTab->update();
        return redirect()->route('itineraries.index')->withStatus('Itinerary Guest Updated');
    }

    public function updateFileName(Request $request)
    {   
        $ItineraryGeneralInfoTab = ItineraryGeneralInfoTab::find($request->input('itinerary_update_file_name'));
        $ItineraryGeneralInfoTab->itinerary_geninfo_file_name     = ($request->input('update_file_name_td_value'));
        $ItineraryGeneralInfoTab->update();
        return redirect()->route('itineraries.index')->withStatus('Itinerary File Name Updated');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Itinerary  $itinerary
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
            $content_details_tabs_all = ItineraryGeneralInfoTab::findOrFail($id);
            // dd($content_details_tabs_all);
            $content_details_tabs_all->delete();
            return redirect()->route('itineraries.index')->withStatus(__('Itinerary deleted'));  
    }
}