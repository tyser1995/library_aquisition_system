<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Http\UploadFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image as Image;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {        
        $this->middleware('permission:media-list', ['only' => ['index']]);
        $this->middleware('permission:media-create', ['only' => ['create','store','bulk_store']]);
        $this->middleware('permission:media-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:media-delete', ['only' => ['destroy']]);
    }

    public function index(Media $media)
    {
        //
        return view('media.index', [
            'media' => $media->orderBy('created_at','DESC')->paginate(18)
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
        $media = Media::all();
        return view('media.create', [
            'media' => $media
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function bulk_store(Request $request){
        $media = new Media();
        $tag = new Tag();

        if(isset($request->tag_name)){//if not null
            $image = $request->file('image');
            $image_name = request()->file->getClientOriginalName();
            $media -> name=explode('.',$image_name)[0];
            $media -> image=$image_name;
            $media -> tag_name=$request->input('tag_name');
            $media->created_by_user_id = Auth::user()->id;
            $media->save();

            $get_media_id = $media->id;

            //
            $image = request()->file('file');
            $get_file_extension = $image->getClientOriginalExtension();
            $num_folder = 1;
            $destination_path = public_path().'/others/';
            //Original File
            $orig_num_folder = $get_media_id;
            $destination_path_orig = public_path().'/images/gallery/'.$orig_num_folder.'/';
            if($get_file_extension == "png" || $get_file_extension == "jpeg" || $get_file_extension == "jpg" || $get_file_extension == "gif"){
                if(!File::exists($destination_path_orig)){
                    File::makeDirectory($destination_path_orig,0777,true);
                }

                $destination_path = public_path().'/others/'.$orig_num_folder.'/';
                if(!File::exists($destination_path)){
                    File::makeDirectory($destination_path,0755,true);
                }

                $pathDir = public_path()."/thumbnail/";
                if(!file_exists($pathDir)){
                    File::makeDirectory($pathDir,0755,true);
                }
            }




            $tag->node_id=$get_media_id;

            if($get_file_extension == "png" || $get_file_extension == "jpeg" || $get_file_extension == "jpg" || $get_file_extension == "gif"){
                $imgFileOrig = Image::make($image)->save($destination_path_orig.$image_name);
                $imgFile = Image::make($image)->resize(140,140)->save($pathDir.$image_name);
                $imgFile2 = Image::make($image)->resize(562,360)->save($destination_path.'562x360'.$image_name);
                $imgFile3 = Image::make($image)->resize(350,225)->save($destination_path.'350x225'.$image_name);
                $imgFile4 = Image::make($image)->resize(1920,1200)->save($destination_path.'1920x1200'.$image_name);

                $tag->type='Media';
            }

            if($get_file_extension == "mp4" || $get_file_extension == "mov"){
                request()->file->move(public_path('upload'),  $get_media_id.'-'.$image_name);

                $tag->type='Video';
            }

            // if($get_file_extension == "pdf" || $get_file_extension == "doc" ||  $get_file_extension == "docx" || $get_file_extension == "xls" || $get_file_extension == "xlsx" ||  $get_file_extension == "ppt" || $get_file_extension == 'pptx' || $get_file_extension == 'rtf'){
            //     request()->file->move(public_path('documents'), $get_media_id.'-'.$image_name);

            //     $tag->type='Documents';
            // }

            $tag->save();
            return response()->json(['uploaded'=>'/upload/'.$image_name]);
        }
        else{
            $image = $request->file('image');
            $image_name = request()->file->getClientOriginalName();
            $media -> name=explode('.',$image_name)[0];
            $media -> image=$image_name;
            $media->created_by_user_id = Auth::user()->id;
            $media->save();

            $get_media_id = $media->id;

            //
            $image = request()->file('file');
            $get_file_extension = $image->getClientOriginalExtension();
            $num_folder = 1;
            $destination_path = public_path().'/others/';
            //Original File
            $orig_num_folder = $get_media_id;
            $destination_path_orig = public_path().'/images/gallery/'.$orig_num_folder.'/';
            if($get_file_extension == "png" || $get_file_extension == "jpeg" || $get_file_extension == "jpg" || $get_file_extension == "gif"){
                if(!File::exists($destination_path_orig)){
                    File::makeDirectory($destination_path_orig,0777,true);
                }

                $destination_path = public_path().'/others/'.$orig_num_folder.'/';
                if(!File::exists($destination_path)){
                    File::makeDirectory($destination_path,0755,true);
                }

                $pathDir = public_path()."/thumbnail/";
                if(!file_exists($pathDir)){
                    File::makeDirectory($pathDir,0755,true);
                }
            }




            $tag->node_id=$get_media_id;

            if($get_file_extension == "png" || $get_file_extension == "jpeg" || $get_file_extension == "jpg" || $get_file_extension == "gif"){
                $imgFileOrig = Image::make($image)->save($destination_path_orig.$image_name);
                $imgFile = Image::make($image)->resize(140,140)->save($pathDir.$image_name);
                $imgFile2 = Image::make($image)->resize(562,360)->save($destination_path.'562x360'.$image_name);
                $imgFile3 = Image::make($image)->resize(350,225)->save($destination_path.'350x225'.$image_name);
                $imgFile4 = Image::make($image)->resize(1920,1200)->save($destination_path.'1920x1200'.$image_name);

                $tag->type='Media';
            }

            if($get_file_extension == "mp4" || $get_file_extension == "mov"){
                request()->file->move(public_path('upload'),  $get_media_id.'-'.$image_name);

                $tag->type='Video';
            }

            // if($get_file_extension == "pdf" || $get_file_extension == "doc" ||  $get_file_extension == "docx" || $get_file_extension == "xls" || $get_file_extension == "xlsx" ||  $get_file_extension == "ppt" || $get_file_extension == 'pptx' || $get_file_extension == 'rtf'){
            //     request()->file->move(public_path('documents'), $get_media_id.'-'.$image_name);

            //     $tag->type='Documents';
            // }

            $tag->save();
            return response()->json(['uploaded'=>'/upload/'.$image_name]);
        }
    }
    public function store(Request $request, Media $media)
    {
        $media = new Media();
        $tag = new Tag();
        $get_file_extension = $request->file('image')->getClientOriginalExtension();
        if($get_file_extension == "mp4" || $get_file_extension == "mov"){
            $image_name = $request->file('image')->getClientOriginalName();
            $media -> name=explode('.',$image_name)[0];
            //Insert input
            $media -> name=$request->input('name');
            $media -> caption=$request->input('caption');
            $media -> image=$image_name;
            $media->created_by_user_id = Auth::user()->id;
            //$media -> path=$path_public;
            $getTagName = $request->input('tag_name');
            $media -> tag_name=$request->input('tag_name');
            $tag -> tag_name=$request->input('tag_name');

            $media->save();

            $get_media_id = $media->id;

            $request->file('image')->move(public_path('upload'),  $get_media_id.'-'.$image_name);

            $tag->node_id=$get_media_id;
            $tag->type='Video';
            $tag->save();

            return redirect()->route('library/media')->withStatus(__('Media added'));
        }else{
            if($request->hasFile('image')){
                $image = $request->file('image');
                $image_name = $image->getClientOriginalName();
                //
                $input['image'] = $image_name;

                //Insert input
                $media -> name=$request->input('name');
                $media -> caption=$request->input('caption');
                $media -> image=$image_name;
                $media->created_by_user_id = Auth::user()->id;
                //$media -> path=$path_public;
                $getTagName = $request->input('tag_name');
                $media -> tag_name=$request->input('tag_name');
                $tag -> tag_name=$request->input('tag_name');

                $media->save();

                $get_media_id = $media->id;

                //
                $num_folder = 1;
                $destination_path = public_path().'/others/';
                //Original File
                $orig_num_folder = $get_media_id;
                $destination_path_orig = public_path().'/images/gallery/'.$orig_num_folder.'/';
                if(!File::exists($destination_path_orig)){
                    File::makeDirectory($destination_path_orig,0777,true);
                }

                $destination_path = public_path().'/others/'.$orig_num_folder.'/';
                if(!File::exists($destination_path)){
                    File::makeDirectory($destination_path,0755,true);
                }

                $pathDir = public_path()."/thumbnail/";
                if(!file_exists($pathDir)){
                    File::makeDirectory($pathDir,0755,true);
                }

                //$path_public = $request->file('image')->storeAs($destination_path_orig,$image_name);

                if(isset($image)){
                    $imgFileOrig = Image::make($image)->save($destination_path_orig.$image_name);
                    $imgFile = Image::make($image)->resize(140,140)->save($pathDir.$image_name);
                    $imgFile2 = Image::make($image)->resize(562,360)->save($destination_path.'562x360'.$image_name);
                    $imgFile3 = Image::make($image)->resize(350,225)->save($destination_path.'350x225'.$image_name);
                    $imgFile4 = Image::make($image)->resize(1920,1200)->save($destination_path.'1920x1200'.$image_name);
                }

                //$media -> path=$path_public;

                $tag->node_id=$get_media_id;
                $tag->type='Media';
                $tag->save();

                return redirect()->route('library/media')->withStatus(__('Media added'));
            }
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
        $media = Media::find($id);
        $tag = Tag::find($id);
        return response()->json([
            'status'=>200,
            'media'=>$media
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $media_id = $request->input('media_id');
        $media = Media::find($media_id);
        $tag = Tag::find($media_id);

        $image = $request->file('image');
        if(!isset($image)){
            $media -> name=$request->input('name');
            $media -> caption=$request->input('caption');
            $media -> tag_name= $request->input('tag_name');

            //Tags
            // $tag = Tag::where('node_id', '=', $media_id)->get()->first();
            if($tag){
                $tag -> tag_name=$request->input('tag_name');
                $tag->update();
            }

            $media->update();
            return redirect()->route('library/media')->withStatus(__('Media updated'));
        }else{
            $get_file_extension = $request->file('image')->getClientOriginalExtension();
            if($get_file_extension == "mp4" || $get_file_extension == "mov"){
                //get delete previous image
                $exist_image = $media->image;
                $getFolderNum = $media_id;//get the folder name

                File::delete('images/gallery/'.$getFolderNum.'/'.$exist_image);
                File::deleteDirectory('images/gallery/'.$getFolderNum);
                File::delete('others/'.$getFolderNum.'/350x225'.$exist_image);
                File::delete('others/'.$getFolderNum.'/562x360'.$exist_image);
                File::delete('others/'.$getFolderNum.'/1920x1200'.$exist_image);
                File::deleteDirectory('others/'.$getFolderNum);
                File::delete('thumbnail/' . $media->image);
                File::delete('upload/' . $media->id.'-'.$media->image);

                $image_name = $request->file('image')->getClientOriginalName();
                $media -> name=explode('.',$image_name)[0];
                $media -> image=$image_name;
                $media->created_by_user_id = Auth::user()->id;

                $request->file('image')->move(public_path('upload'),  $media_id.'-'.$image_name);

                $media -> name=$request->input('name');
                $media -> caption=$request->input('caption');
                $media -> tag_name= $request->input('tag_name');
                $media -> image=$image_name;

                //Tags
                $tag = Tag::where('node_id', '=', $media_id)->get()->first();
                if($tag){
                    $tag -> tag_name=$request->input('tag_name');
                    $tag->type='Video';
                    $tag->update();
                }
                $media->update();
                return redirect()->route('library/media')->withStatus(__('Media updated'));
            }else{
                //get delete previous image
                $exist_image = $media->image;
                $getFolderNum = $media_id;//get the folder name

                File::delete('images/gallery/'.$getFolderNum.'/'.$exist_image);
                File::deleteDirectory('images/gallery/'.$getFolderNum);
                File::delete('others/'.$getFolderNum.'/350x225'.$exist_image);
                File::delete('others/'.$getFolderNum.'/562x360'.$exist_image);
                File::delete('others/'.$getFolderNum.'/1920x1200'.$exist_image);
                File::deleteDirectory('others/'.$getFolderNum);
                File::delete('thumbnail/' . $media->image);
                File::delete('upload/' . $media->id.'-'.$media->image);

                if($request->hasFile('image')){
                    //$destination_path = 'others';//other sizes
                    $pathDir = public_path()."/thumbnail/";//thumbnail

                    $image = $request->file('image');
                    $image_name = $image->getClientOriginalName();

                    $input['image'] = $image_name;
                    //Original File
                    $orig_num_folder = $media_id;
                    $destination_path = public_path().'/others/';
    
                    $destination_path_orig = public_path().'/images/gallery/'.$orig_num_folder.'/';
                    if(!File::exists($destination_path_orig)){
                        File::makeDirectory($destination_path_orig,0777,true);
                    }

                    $destination_path = public_path().'/others/'.$orig_num_folder.'/';
                    if(!File::exists($destination_path)){
                        File::makeDirectory($destination_path,0755,true);
                    }

                    $pathDir = public_path()."/thumbnail/";
                    if(!file_exists($pathDir)){
                        File::makeDirectory($pathDir,0755,true);
                    }


                    //captured and update image
                    if(isset($image)){
                        $imgFileOrig = Image::make($image)->save($destination_path_orig.'/'.$image_name);
                        $imgFile = Image::make($image)->resize(140,140)->save($pathDir.$image_name);
                        $imgFile2 = Image::make($image)->resize(562,360)->save($destination_path.'/'.'562x360'.$image_name);
                        $imgFile3 = Image::make($image)->resize(350,225)->save($destination_path.'/'.'350x225'.$image_name);
                        $imgFile4 = Image::make($image)->resize(1920,1200)->save($destination_path.'/'.'1920x1200'.$image_name);
                    }

                    $media -> name=$request->input('name');
                    $media -> caption=$request->input('caption');
                    $media -> tag_name= $request->input('tag_name');
                    $media -> image=$image_name;

                    //Tags
                    $tag = Tag::where('node_id', '=', $media_id)->get()->first();
                    if($tag){
                        $tag -> tag_name=$request->input('tag_name');
                        $tag->update();
                    }
                    $media->update();


                    return redirect()->route('library/media')->withStatus(__('Media updated'));
                }
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Media $medias)
    {
        //
        $media = Media::find($id);
        $getFolderNum = $id;
        //Delete files with folder created
        File::delete('images/gallery/'.$getFolderNum.'/'. $media->image);//remove file in storage
        File::deleteDirectory('images/gallery/'.$getFolderNum);


        File::delete('others/'.$getFolderNum.'/350x225'. $media->image);
        File::delete('others/'.$getFolderNum.'/562x360'. $media->image);
        File::delete('others/'.$getFolderNum.'/1920x1200'. $media->image);
        File::deleteDirectory('others/'.$getFolderNum);

        File::delete('thumbnail/' . $media->image);//remove thumbnail
        File::delete('upload/' . $media->id.'-'.$media->image);

        $media->delete();
        return redirect()->route('library/media')->withStatus(__('Media deleted'));
    }
}