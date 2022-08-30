<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Http\UploadFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permission:document-list', ['only' => ['index']]);
        $this->middleware('permission:document-create', ['only' => ['create','store']]);
        $this->middleware('permission:document-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:document-delete', ['only' => ['destroy']]);
    }
    public function index(Document $document)
    {
        $d = Document::all();
        return view('documents.index', [
            'document' => $d->toArray()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $obj_document = Document::all();
        return view('document.create', [
            'document' => $document
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Document $document)
    {
        $obj_document = new Document();
        $tag = new Tag();
       if($request->hasFile('document')){
            $document = $request->file('document');
            $document_name = $document->getClientOriginalName();
            $get_file_extension = $document->getClientOriginalExtension();
            if($get_file_extension == "pdf"){
                //
                $input['document'] = $document_name;
                
                //Insert input
                $obj_document -> name=$request->input('name');
                $obj_document -> caption=$request->input('caption');
                $obj_document -> filename=$document_name;
                
                //$document -> path=$path_public;
                $getTagName = $request->input('tag_name');
                $obj_document -> tag_name=$request->input('tag_name');
                $tag -> tag_name=$request->input('tag_name');

                $obj_document->save();

                $get_document_id = $obj_document->id;

                //
                $num_folder = 1;
                $destination_path = public_path().'/documents/';
                //Original File
                $orig_num_folder = $get_document_id;
                
                if(!File::exists($destination_path)){
                    $destination_path = public_path().'/documents/'.$orig_num_folder.'/';
                    File::makeDirectory($destination_path,0755,true);
                }
                else{
                    //$num_folder++;
                    $destination_path = public_path().'/documents/'.$orig_num_folder.'/';
                    File::makeDirectory($destination_path,0755,true);
                }

                //$path_public = $request->file('document')->storeAs($destination_path,$document_name);
                $tmp_name = $_FILES["document"]["tmp_name"];
                move_uploaded_file($tmp_name, "$destination_path/$document_name");
                
                $tag->node_id=$get_document_id;
                $tag->type='Document';
                $tag->save();

                return redirect()->route('library/document')->withStatus(__('Document added'));
            }else{
                return redirect()->route('library/document')->withError(__('Invalid file format'));
            }
        }else{
            return redirect()->route('library/document')->withError(__('Unable to upload'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Document  $document
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
        
        $obj_document = Document::find($id);
        $tag = Tag::find($id);
        return response()->json([
            'status'=>200,
            'document'=>$obj_document
        ]);    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $document_id = $request->input('document_id');
        $obj_document = Document::find($document_id);
        $tag = Tag::find($document_id);

        $document = $request->file('document');
        if(!isset($document)){//if null text not change
            $obj_document -> name=$request->input('name');
            $obj_document -> caption=$request->input('caption');
            $obj_document -> tag_name= $request->input('tag_name');
            
            //Tags
            // $tag = Tag::where('node_id', '=', $document_id)->get()->first();
            if($tag){
                $tag -> tag_name=$request->input('tag_name');
                $tag->update();
            }

            $obj_document->update();
            return redirect()->route('library/document')->withStatus(__('Document updated'));
        }else{
            $get_file_extension = $document->getClientOriginalExtension();
            if($get_file_extension == "pdf"){
                //get delete previous document
                $exist_document = $obj_document->filename;
                $getFolderNum = $document_id;//get the folder name

                File::delete(public_path().'/documents/'.$getFolderNum.'/'.$exist_document);

                if($request->hasFile('document')){
                    //File Storage path
                    $destination_path = public_path().'/documents/'.$getFolderNum.'/';
                    $document = $request->file('document');
                    $document_name = $document->getClientOriginalName();
                    //$path = $request->file('document')->storeAs($destination_path_orig.'/'.$getFolderNum,$document_name);
                    $tmp_name = $_FILES["document"]["tmp_name"];
                    move_uploaded_file($tmp_name, "$destination_path/$document_name");


                    $obj_document -> name=$request->input('name');
                    $obj_document -> caption=$request->input('caption');
                    $obj_document -> tag_name= $request->input('tag_name');
                    $obj_document -> filename=$document_name;

                    //Tags
                    $tag = Tag::where('node_id', '=', $document_id)->get()->first();
                    if($tag){
                        $tag -> tag_name=$request->input('tag_name');
                        $tag->update();
                    }
                    $obj_document->update();
                    

                    return redirect()->route('library/document')->withStatus(__('Document updated'));
                }else{
                    return redirect()->route('library/document')->withError(__('Invalid file'));
                }
            }else{
                return redirect()->route('library/document')->withError(__('Invalid file format'));
            }
            
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Document $obj_document)
    {
        //
        $obj_document = Document::find($id);
        $getFolderNum = $id;
        //Delete files with folder created
        Storage::delete('public/documents/'.$getFolderNum.'/'. $obj_document->document);//remove file in storage
        Storage::deleteDirectory('public/documents/'.$getFolderNum);

        File::delete('public/documents/'.$getFolderNum.'/350x225'. $obj_document->document);
        File::delete('public/documents/'.$getFolderNum.'/562x360'. $obj_document->document);
        File::delete('public/documents/'.$getFolderNum.'/1920x1200'. $obj_document->document);
        File::deleteDirectory('public/documents/'.$getFolderNum);

        File::delete('public/documents/' . $obj_document->document);//remove thumbnail

        $obj_document->delete();
        return redirect()->route('library/document')->withStatus(__('Document deleted'));
    }
}

