<?php

namespace App\Http\Controllers;

use App\Models\ItineraryTab;
use App\Models\ItineraryEditor;
use App\Models\ContentPageEditor;
use App\Models\ItineraryGeneralInfoTab;
use App\Models\ContentType;
use Illuminate\Http\Request;

class ItineraryTabController extends Controller
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
        $ContentType = ContentType::where('id','=',$ItineraryGeneralInfoTab->content_type_id)->get()->first();
        $content = ContentPageEditor::all();
        return view('itineraries_itinerary.create',[
            'content'=>$content,
            'ItineraryGeneralInfoTab' => $ItineraryGeneralInfoTab,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $editor = new ContentPageEditor;
        $editor->title = $request->title;
        $editor->description = $request->description;
        $editor->html_entities = htmlspecialchars($request->description);
        $editor->content_details_tabs_id = $request->itinerary_general_info_tabs_id;
        $editor->save();

        if ($editor) {
            return back()->withStatus('Itinerary Pages Created!!!');
        } else {
            return back()->with("failed", "Failed! Itineraries not created");
        }
    }

    public function add_another(Request $request){
        $editor = new ContentPageEditor;
        $editor->title = $request->title;
        $editor->description = $request->description;
        $editor->html_entities = htmlspecialchars($request->description);
        $editor->content_details_tabs_id = $request->itinerary_general_info_tabs_id;
        $editor->save();

        if ($editor) {
            return back();
        } else {
            return back()->with("failed", "Failed! Itineraries not created");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ItineraryTab  $itineraryTab
     * @return \Illuminate\Http\Response
     */
    public function show(ItineraryTab $itineraryTab)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ItineraryTab  $itineraryTab
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $content = ContentPageEditor::where('content_details_tabs_id',$id)->get();
        $ItineraryGeneralInfoTab = ItineraryGeneralInfoTab::where('id','=',$id)->get()->first();
        $ContentType = ContentType::where('id','=',$ItineraryGeneralInfoTab->itinerary_types_id)->get()->first();
        //($content) ? $content : $content = null;
        return view('itineraries_itinerary.edit',[
            'content'=>$content,
            'ItineraryGeneralInfoTab'=>$ItineraryGeneralInfoTab,
            'ContentType' => $ContentType,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ItineraryTab  $itineraryTab
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        //
        $editor = ContentPageEditor::find($id);
        $editor->title = $request->title;
        $editor->description = $request->description;
        $editor->html_entities = htmlspecialchars($request->description);
        $editor->update();
        if ($editor) {
            //$contentPagesTab = ContentPage::where('content_details_tabs_id','=',$request->content_details_tabs)->get()->first();
            //return redirect()->route('itinerary_tab.edit',$contentPagesTab->content_details_tabs_id)->withStatus('Itinerary Pages Updated!!!');
            return back()->withStatus('Itinerary Pages Updated!!!');
        } else {
            return back()->with("failed", "Failed! Itineraries not updated");
        }
    }

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
     * @param  \App\Models\ItineraryTab  $itineraryTab
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $editor = ContentPageEditor::find($id);
        $editor->delete();
        if ($editor) {
            return back()->with("success", "Success! Itineraries deleted");
        } else {
            return back()->with("failed", "Failed! Itineraries not deleted");
        }
    }
}
