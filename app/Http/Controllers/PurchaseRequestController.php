<?php

namespace App\Http\Controllers;

use App\Models\PurchaseRequest;
use App\Models\PurchaseRequestApproverUser;
use App\Models\PurchaseRequestRecommendedUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseRequestController extends Controller
{
    function __construct()
    {       
        $this->middleware('permission:purchase_request-list', ['only' => ['index','data']]);
        $this->middleware('permission:purchase_request-create', ['only' => ['create','store']]);
        $this->middleware('permission:purchase_request-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:purchase_request-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('purchase_requests.index');
    }

    public function data(){
        // $purchase_requests = PurchaseRequest::all();
        // dd(explode(',', $purchase_requests[0]->author_name));
       
        if(in_array(Auth::user()->role,['1','2','3'])){
            $purchase_requests = DB::table('purchase_requests')
            ->join('users','users.id','=','purchase_requests.created_by_users_id')
            ->select('purchase_requests.*','users.name')
            ->get();

            return response()->json([
                'data' => $purchase_requests,
            ]);
        }else{
            $purchase_requests = DB::table('purchase_requests')
            ->join('users','users.id','=','purchase_requests.created_by_users_id')
            ->where('users.role','=',Auth::user()->role)
            ->select('purchase_requests.*','users.name')
            ->get();

            return response()->json([
                'data' => $purchase_requests,
            ]);
        }
        
        // $purchase_requests = DB::table('purchase_requests')
        // ->join('users','users.id','=','purchase_requests.created_by_users_id')
        // ->select('purchase_requests.*','users.name')
        // ->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $purchase_request_recommended_users = PurchaseRequestRecommendedUser::all();
        $purchase_request_approver_users = PurchaseRequestApproverUser::all();
        return view('purchase_requests.create',[
            'purchase_request_recommended_users' => $purchase_request_recommended_users,
            'purchase_request_approver_users' => $purchase_request_approver_users,
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
        $purchase_requests = new PurchaseRequest();
        //dynamic fields <starts>
        $purchase_requests -> created_by_users_id = Auth::user()->id;
        $purchase_requests -> rush_type = implode(',',$request->input('rush_type'));
        $purchase_requests -> author_name = implode(',',$request->input('author_name'));
        $purchase_requests -> title = implode(',',$request->input('title'));
        $purchase_requests -> edition = implode(',',$request->input('edition'));
        $purchase_requests -> copies_vol = implode(',',$request->input('copies_vol'));
        $purchase_requests -> publication_date = implode(',',$request->input('publication_date'));
        $purchase_requests -> publisher_name = implode(',',$request->input('publisher_name'));
        $purchase_requests -> publisher_address = implode(',',$request->input('publisher_address'));
        $purchase_requests -> recommended_user_id = implode(',',$request->input('recommended_user_id'));
        $purchase_requests -> approver_user_id = implode(',',$request->input('approver_user_id'));
        $purchase_requests -> charge_to = implode(',',$request->input('charge_to'));
        $purchase_requests -> subject = implode(',',$request->input('subject'));
        $purchase_requests -> existing_no_of_titles = implode(',',$request->input('existing_no_of_titles'));
        $purchase_requests -> note = implode(',',$request->input('note'));
        //dynamic fields <ends>
        $purchase_requests->save();
        return redirect()->route('purchase_request.index')->withStatus('Successfully Added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PurchaseRequest  $purchaseRequest
     * @return \Illuminate\Http\Response
     */
    public function show(PurchaseRequest $purchaseRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PurchaseRequest  $purchaseRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(PurchaseRequest $purchaseRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PurchaseRequest  $purchaseRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PurchaseRequest $purchaseRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PurchaseRequest  $purchaseRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(PurchaseRequest $purchaseRequest)
    {
        //
    }

    public function delete($id){
        $purchase_requests = PurchaseRequest::findOrfail($id);
        $purchase_requests->delete();
        return redirect()->route('purchase_request.index')->withError('Deleted Successfully ' .$purchase_requests->title);
    }
}
