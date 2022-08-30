<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ItineraryEditor;
use App\Models\ContentPage;
use DB;
use Illuminate\Http\UploadFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RichTextEditorController extends Controller
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

    public function preview_template()
    {
        $content = ItineraryEditor::all();
        return view('rich_text_editor.preview', compact('content'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $content = ItineraryEditor::all();
        return view('rich_text_editor.create',[
            'content' => $content
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
        // $postRequest = array(
        //     "title" => $request->title,
        //     "description" => $request->description,
        //     'html_entities' => htmlspecialchars($request->description),
        // );
        //dd($postRequest);
        //$post = ItineraryEditor::create($postRequest);
        $editor = new ItineraryEditor;
        $editor->title = $request->title;
        $editor->description = $request->description;
        $editor->html_entities = htmlspecialchars($request->description);
        $editor->save();

        if ($editor) {
            return back()->withStatus('Content Pages Created!!!');
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
        $content = ItineraryEditor::find($id);
        $content_details_tabs = DB::table('content_details_tabs')
            ->join('itinerary_editors', 'content_details_tabs.id', '=', 'itinerary_editors.content_details_tab_and_itinerary_general_info_tab_id')
            ->select('content_details_tabs.id')
            ->where('itinerary_editors.id', $id)
            ->get()
            ->first();
        return view('rich_text_editor.edit',[
            'content' => $content,
            'content_details_tabs' => $content_details_tabs
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
        $editor = ItineraryEditor::find($id);
        $editor->title = $request->title;
        $editor->description = $request->description;
        $editor->html_entities = htmlspecialchars($request->description);
        $editor->update();
        if ($editor) {
            $contentPagesTab = ContentPage::where('content_details_tabs_id','=',$request->content_details_tabs)->get()->first();
            return redirect()->route('content_pages.edit',$contentPagesTab->content_details_tabs_id)->withStatus('Content Pages Updated!!!');
            // return back()->with("success", "Success! Itineraries updated");
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
            return back()->with("success", "Success! Itineraries deleted");
        } else {
            return back()->with("failed", "Failed! Itineraries not deleted");
        }
    }
}
