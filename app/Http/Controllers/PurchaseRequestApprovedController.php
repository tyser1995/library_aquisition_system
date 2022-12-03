<?php

namespace App\Http\Controllers;

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

class PurchaseRequestApprovedController extends Controller
{
    function __construct()
    {       
        $this->middleware('permission:purchase_request_approved-list', ['only' => ['index','data']]);
        $this->middleware('permission:purchase_request_approved-create', ['only' => ['create','store']]);
        $this->middleware('permission:purchase_request_approved-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:purchase_request_approved-delete', ['only' => ['destroy','delete']]);
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
                ->where('purchase_requests.status_id','=',10)
                ->get();
            }else{
                $purchase_requests = DB::table('purchase_requests')
                ->join('users','users.id','=','purchase_requests.created_by_users_id')
                ->select('purchase_requests.*','users.name')
                ->where('purchase_requests.deleted_flag','=',0)
                ->where('purchase_requests.status_id','=',10)
                ->get();
            }
          

            return view('purchase_approved.index',[
                'purchase_request' => $purchase_requests,
            ]);
        }else{
            $dean = User::join('roles','roles.id','=','users.role')
            ->select('roles.name')
            ->where('users.id','=',Auth::user()->id)
            ->get()
            ->first();

            $department_id = Employee::where('users_id','=',Auth::user()->id)
            ->get()
            ->first();

            if(strtoupper($dean->name) =="DEAN" || strtoupper($dean->name) == "VPAA" || strtoupper($dean->name) == "PRESIDENT" || strtoupper($dean->name) == "VPFA" || strtoupper($dean->name) == "DIRECTOR OF LIBRARY" ){
                if(strtoupper($dean->name) =="DEAN"){
                    $purchase_requests = DB::table('purchase_requests')
                    ->join('users','users.id','=','purchase_requests.created_by_users_id')
                    ->join('employees','employees.users_id','=','users.id')
                    ->where('employees.department_names_id','=',$department_id->department_names_id)
                    ->where('purchase_requests.deleted_flag','=',0)
                    ->where('purchase_requests.status_id','=',10)
                    ->select('purchase_requests.*','users.name')
                    ->get();
    
                    return view('purchase_approved.index',[
                        'purchase_request' => $purchase_requests
                    ]);
                }else{
                    if(strtoupper($dean->name) =="VPAA"){
                        $purchase_requests = DB::table('purchase_requests')
                        ->join('users','users.id','=','purchase_requests.created_by_users_id')
                        ->select('purchase_requests.*','users.name')
                        ->where('purchase_requests.deleted_flag','=',0)
                        ->where('purchase_requests.status_id','=',10)
                        ->get();
            
                        return view('purchase_approved.index',[
                            'purchase_request' => $purchase_requests,
                        ]);
                    }else if(strtoupper($dean->name) =="VPFA"){
                        $purchase_requests = DB::table('purchase_requests')
                        ->join('users','users.id','=','purchase_requests.created_by_users_id')
                        ->select('purchase_requests.*','users.name')
                        ->where('purchase_requests.deleted_flag','=',0)
                        ->where('purchase_requests.status_id','=',10)
                        ->get();
            
                        return view('purchase_approved.index',[
                            'purchase_request' => $purchase_requests,
                        ]);
                    }
                    
                }
                
            }else{
                $purchase_requests = DB::table('purchase_requests')
                ->join('users','users.id','=','purchase_requests.created_by_users_id')
                ->where('users.id','=',Auth::user()->id)
                ->where('purchase_requests.deleted_flag','=',0)
                ->where('purchase_requests.status_id','=',10)
                ->select('purchase_requests.*','users.name')
                ->get();

                return view('purchase_approved.index',[
                    'purchase_request' => $purchase_requests
                ]);
            }
        }
    }

    public function print_preview($id){
        //
        $roles = DB::table('roles')
        ->select('name')
        ->get()
        ->toArray();

        $purchase_request_recommended_users = PurchaseRequestRecommendedUser::all();
        $purchase_request_approver_users = PurchaseRequestApproverUser::all();

        if(in_array(Auth::user()->role,['1','2','3','8'])){
            if(Auth::user()->role == 3 || Auth::user()->role == 8){
                $purchase_requests = DB::table('purchase_requests')
                ->join('users','users.id','=','purchase_requests.created_by_users_id')
                ->select('purchase_requests.*','users.name')
                ->where('purchase_requests.deleted_flag','=',0)
                ->where('purchase_requests.status_id','=',10)
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
