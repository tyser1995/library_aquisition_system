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


class ReportManagementController extends Controller
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

    public function by_department(){
        $roles = DB::table('roles')
        ->select('name')
        ->get()
        ->toArray();

        $purchase_requests = DB::table('purchase_requests')
        ->join('users','users.id','=','purchase_requests.created_by_users_id')
        ->join('department_names','department_names.id','=','purchase_requests.department_names_id')
        ->select('purchase_requests.*','users.name','department_names.department_name')
        ->where('purchase_requests.deleted_flag','=',0)
        ->where('purchase_requests.status_id','=',11)
        ->get();

        return view('report_management.department.index',[
            'purchase_request' => $purchase_requests,
        ]);
    }

    public function holding(){
        $roles = DB::table('roles')
        ->select('name')
        ->get()
        ->toArray();

        $purchase_requests = DB::table('purchase_requests')
        ->join('users','users.id','=','purchase_requests.created_by_users_id')
        ->select('purchase_requests.*','users.name')
        ->where('purchase_requests.deleted_flag','=',0)
        ->where('purchase_requests.status_id','=',11)
        ->get();

        return view('report_management.holdings.index',[
            'purchase_request' => $purchase_requests,
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
    }
}
