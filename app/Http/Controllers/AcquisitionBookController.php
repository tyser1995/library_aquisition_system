<?php

namespace App\Http\Controllers;

use App\Models\AcquisitionBook;
use App\Models\PurchaseRequest;
use App\Models\PurchaseRequestApproverUser;
use App\Models\PurchaseRequestRecommendedUser;
use App\Models\DepartmentName;
use App\Models\User;
use App\Models\Employee;
use App\Models\SignatureAttachment;
use App\Models\Publisher;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AcquisitionBookController extends Controller
{
    function __construct()
    {       
        $this->middleware('permission:acquisition_books-list', ['only' => ['index','data']]);
        $this->middleware('permission:acquisition_books-create', ['only' => ['create','store']]);
        $this->middleware('permission:acquisition_books-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:acquisition_books-delete', ['only' => ['destroy','delete']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $roles = DB::table('roles')
        ->select('name')
        ->get()
        ->toArray();

        if(in_array(Auth::user()->role,['1','2','3'])){
            if(Auth::user()->role == 3){
                $purchase_requests = DB::table('purchase_requests')
                ->join('users','users.id','=','purchase_requests.created_by_users_id')
                ->select('purchase_requests.*','users.name')
                ->where('purchase_requests.deleted_flag','=',0)
                ->where('purchase_requests.status_id','=',11)
                ->get();
            }else{
                $purchase_requests = DB::table('purchase_requests')
                ->join('users','users.id','=','purchase_requests.created_by_users_id')
                ->select('purchase_requests.*','users.name')
                ->where('purchase_requests.deleted_flag','=',0)
                ->where('purchase_requests.status_id','=',11)
                ->get();
            }
          

            return view('acquisition_books.index',[
                'purchase_request' => $purchase_requests,
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Models\AcquisitionBook  $acquisitionBook
     * @return \Illuminate\Http\Response
     */
    public function show(AcquisitionBook $acquisitionBook)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AcquisitionBook  $acquisitionBook
     * @return \Illuminate\Http\Response
     */
    public function edit(AcquisitionBook $acquisitionBook)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AcquisitionBook  $acquisitionBook
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AcquisitionBook $acquisitionBook)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AcquisitionBook  $acquisitionBook
     * @return \Illuminate\Http\Response
     */
    public function destroy(AcquisitionBook $acquisitionBook)
    {
        //
    }

    public function approved($id){
        $purchase_requests = PurchaseRequest::findOrfail($id);
        //$user->deleted_flag = 1;
        $purchase_requests->status_id = 11;
        $purchase_requests->update();
        return redirect()->route('purchase_approve.index')->withError('Approved Successfully ' .$purchase_requests->title);
    }

    public function print_preview($id){
        //
        $roles = DB::table('roles')
        ->select('name')
        ->get()
        ->toArray();

        $purchase_request_recommended_users = PurchaseRequestRecommendedUser::all();
        $purchase_request_approver_users = PurchaseRequestApproverUser::all();

        if(in_array(Auth::user()->role,['1','2','3'])){
            if(Auth::user()->role == 3){
                $purchase_requests = DB::table('purchase_requests')
                ->join('users','users.id','=','purchase_requests.created_by_users_id')
                ->select('purchase_requests.*','users.name')
                ->where('purchase_requests.deleted_flag','=',0)
                ->where('purchase_requests.status_id','=',11)
                ->where('purchase_requests.id','=',$id)
                ->get();
            }else{
                $purchase_requests = DB::table('purchase_requests')
                ->join('users','users.id','=','purchase_requests.created_by_users_id')
                ->select('purchase_requests.*','users.name')
                ->where('purchase_requests.deleted_flag','=',0)
                ->where('purchase_requests.id','=',$id)
                ->get();
            }
          

            return view('purchase_approved.preview',[
                'purchase_request' => $purchase_requests,
                'purchase_request_recommended_users' => $purchase_request_recommended_users,
                'purchase_request_approver_users' => $purchase_request_approver_users,
            ]);
        }
    }
}
