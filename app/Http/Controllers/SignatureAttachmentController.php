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
        return view('signature_attachment.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('signature_attachment.create');
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
        return view('signature_attachment.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SignatureAttachment  $signatureAttachment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SignatureAttachment $signatureAttachment)
    {
        //
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
