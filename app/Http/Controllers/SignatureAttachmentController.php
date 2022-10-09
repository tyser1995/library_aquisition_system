<?php

namespace App\Http\Controllers;

use App\Models\SignatureAttachment;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class SignatureAttachmentController extends Controller
{
    function __construct()
    {       
        $this->middleware('permission:signature-list', ['only' => ['index','data']]);
        $this->middleware('permission:signature-create', ['only' => ['create','store']]);
        $this->middleware('permission:signature-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:signature-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $signature = SignatureAttachment::join('users','users.id','=','signature_attachment.users_id')
        ->select('signature_attachment.*','users.name')
        ->get();

        return view('signature_attachment.index',[
            'signature' => $signature
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
        $users = User::where('role','>',3)
        ->whereNotExists(function($query) {
            $query->select('sa.users_id')
                  ->from('signature_attachment AS sa')
                  //->where('sa.users_id','=','users.id');
                  ->whereColumn('sa.users_id','users.id');
           })
           ->select('users.*')
           ->get();
       
        return view('signature_attachment.create',[
            'users' => $users
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
        $signature = new SignatureAttachment();
        $signature->users_id = $request->users_id;
        $signature->password = $request->password;
        $signature->save();
        return redirect()->route('signature_attachment.index')->withStatus('Signature Password Added.'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SignatureAttachment  $signatureAttachment
     * @return \Illuminate\Http\Response
     */
    public function show(SignatureAttachment $signatureAttachment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SignatureAttachment  $signatureAttachment
     * @return \Illuminate\Http\Response
     */
    public function edit(SignatureAttachment $signatureAttachment)
    {
        //
        // $signature = SignatureAttachment::join('users','users.id','=','signature_attachment.users_id')
        // ->where('signature_attachment.id','=',$signatureAttachment->id)
        // ->select('signature_attachment.*','users.name')
        // ->get();

        return view('signature_attachment.edit',[
            'signature' => $signatureAttachment
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SignatureAttachment  $signatureAttachment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,SignatureAttachment $signatureAttachment)
    {
        //
        $signature = SignatureAttachment::findOrfail($signatureAttachment->id);
        $signature->password = $request->password;
        $signature->save();
        return redirect()->route('signature_attachment.index')->withStatus('Signature Password Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SignatureAttachment  $signatureAttachment
     * @return \Illuminate\Http\Response
     */
    public function destroy(SignatureAttachment $signatureAttachment)
    {
        //
    }
}
