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
use App\Models\DepartmentBudget;
use App\Models\BudgetBorrow;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PurchaseRequestController extends Controller
{
    function __construct()
    {       
        $this->middleware('permission:purchase_request-list', ['only' => ['index','data']]);
        $this->middleware('permission:purchase_request-create', ['only' => ['create','store']]);
        $this->middleware('permission:purchase_request-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:purchase_request-delete', ['only' => ['destroy','delete']]);
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
                ->where('purchase_requests.status_id','=',2)
                ->orWhere('purchase_requests.status_id','=',6)
                ->get();
            }else{
                $purchase_requests = DB::table('purchase_requests')
                ->join('users','users.id','=','purchase_requests.created_by_users_id')
                ->select('purchase_requests.*','users.name')
                ->where('purchase_requests.deleted_flag','=',0)
                ->get();
            }
          

            return view('purchase_requests.index',[
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

            //9,5,6,4
            if(Auth::user()->role == 9){//Dean
                $purchase_requests = DB::table('purchase_requests')
                ->join('users','users.id','=','purchase_requests.created_by_users_id')
                ->join('employees','employees.users_id','=','users.id')
                ->where('employees.department_names_id','=',$department_id->department_names_id)
                ->where('purchase_requests.deleted_flag','=',0)
                ->where('purchase_requests.status_id','=',0)
                ->select('purchase_requests.*','users.name')
                ->get();

                return view('purchase_requests.index',[
                    'purchase_request' => $purchase_requests
                ]);
            }

            if(Auth::user()->role == 5){ //VPAA
                $purchase_requests = DB::table('purchase_requests')
                        ->join('users','users.id','=','purchase_requests.created_by_users_id')
                        ->select('purchase_requests.*','users.name')
                        ->where('purchase_requests.deleted_flag','=',0)
                        ->where('purchase_requests.status_id','=',1)
                        ->orWhere('purchase_requests.status_id','=',8)
                        ->get();
            
                        return view('purchase_requests.index',[
                            'purchase_request' => $purchase_requests,
                        ]);
            }

            if(Auth::user()->role == 6){//VPFA
                $purchase_requests = DB::table('purchase_requests')
                ->join('users','users.id','=','purchase_requests.created_by_users_id')
                ->select('purchase_requests.*','users.name')
                ->where('purchase_requests.deleted_flag','=',0)
                ->where('purchase_requests.status_id','=',4)
                ->orWhere('purchase_requests.status_id','=',9)
                ->get();
    
                return view('purchase_requests.index',[
                    'purchase_request' => $purchase_requests,
                ]);
            }

            if(Auth::user()->role == 4){//PRESIDENT
                $purchase_requests = DB::table('purchase_requests')
                        ->join('users','users.id','=','purchase_requests.created_by_users_id')
                        ->select('purchase_requests.*','users.name')
                        ->where('purchase_requests.deleted_flag','=',0)
                        ->where('purchase_requests.status_id','=',5)
                        ->get();
            
                        return view('purchase_requests.index',[
                            'purchase_request' => $purchase_requests,
                        ]);
            }

            if(Auth::user()->role == 7){//DOL
                $purchase_requests = DB::table('purchase_requests')
                        ->join('users','users.id','=','purchase_requests.created_by_users_id')
                        ->select('purchase_requests.*','users.name')
                        ->where('purchase_requests.deleted_flag','=',0)
                        ->where('purchase_requests.status_id','=',7)
                        ->get();
            
                        return view('purchase_requests.index',[
                            'purchase_request' => $purchase_requests,
                        ]);
            }

            if(Auth::user()->role == 10){//Faculty
                $purchase_requests = DB::table('purchase_requests')
                ->join('users','users.id','=','purchase_requests.created_by_users_id')
                ->where('users.id','=',Auth::user()->id)
                ->where('purchase_requests.deleted_flag','=',0)
                ->select('purchase_requests.*','users.name')
                ->get();

                return view('purchase_requests.index',[
                    'purchase_request' => $purchase_requests
                ]);
            }
            // if(strtoupper($dean->name) =="DEAN" || strtoupper($dean->name) == "VPAA" || strtoupper($dean->name) == "PRESIDENT" || strtoupper($dean->name) == "VPFA" || strtoupper($dean->name) == "DIRECTOR OF LIBRARY" ){
                
            // }else{
                
            // }
        }
    }

    public function data(){
        // $purchase_requests = PurchaseRequest::all();
        // dd(explode(',', $purchase_requests[0]->author_name));
       
        if(in_array(Auth::user()->role,['1','2','3'])){
            $purchase_requests = DB::table('purchase_requests')
            ->join('users','users.id','=','purchase_requests.created_by_users_id')
            ->select('purchase_requests.*','users.name')
            ->get();

            $role_name = DB::table('roles')
            ->where('id',Auth::user()->role)
            ->get()
            ->first();
            return response()->json([
                'data' => $purchase_requests,
                'role_name' => $role_name->name,
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

    public function department_data(){
        $department_name = DepartmentName::where('deleted_flag','=',0)
        ->orderBy('department_name','asc')
        ->get();

        return response()->json($department_name);
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

        $role_name = DB::table('roles')
            ->where('id',Auth::user()->role)
            ->get()
            ->first();

        $department_name = DepartmentName::join('employees','employees.department_names_id','=','department_names.id')
        ->select('department_names.department_name')
        ->where('employees.users_id','=',Auth::user()->id)
        ->get()
        ->first();

        $department_name_list = DepartmentName::where('deleted_flag','=',0)
        ->orderBy('department_name','asc')
        ->get();

        $publisher = PurchaseRequest::where('publisher_name','!=','')
        ->get();
        
        return view('purchase_requests.create',[
            'purchase_request_recommended_users' => $purchase_request_recommended_users,
            'purchase_request_approver_users' => $purchase_request_approver_users,
            'role_name' => collect($role_name)['name'],
            'department_name' => $department_name,
            'department_name_list' => $department_name_list,
            'publisher' => $publisher
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
        $department_names_id = DepartmentName::where('department_name',$request->input('charge_to')[0])
        ->get()
        ->first();
       
        //dynamic fields <starts>
        $purchase_requests -> created_by_users_id = Auth::user()->id;
        $purchase_requests -> rush_type =implode(',',$request->input('rush_type'));
        $purchase_requests -> author_name = implode(',',$request->input('author_name'));
        $purchase_requests -> title = implode(',',str_replace(",",";",$request->input('title')));
        $purchase_requests -> edition = implode(',',$request->input('edition'));
        $purchase_requests -> copies_vol = implode(',',$request->input('copies_vol'));
        $purchase_requests -> publication_date = implode(',',$request->input('publication_date'));
        $purchase_requests -> publisher_name = implode(',',str_replace(",",";",$request->input('publisher_name')));
        $purchase_requests -> publisher_address = implode(',',str_replace(",",";",$request->input('publisher_address')));
        $purchase_requests -> recommended_user_id = implode(',',$request->input('recommended_user_id'));
        // $purchase_requests -> approver_user_id = implode(',',$request->input('approver_user_id'));
        $purchase_requests -> charge_to = implode(',',$request->input('charge_to'));
        $purchase_requests -> department_names_id = $department_names_id->id;
        $purchase_requests -> subject = implode(',',str_replace(",",";",$request->input('subject')));
        $purchase_requests -> existing_no_of_titles = implode(',',$request->input('existing_no_of_titles'));
        $purchase_requests -> note = implode(',',$request->input('note'));
        //dynamic fields <ends>
        $purchase_requests->save();

        $publisher = new Publisher();
        foreach($request->input('title') as $key => $title_val){
            //echo $key. ' ' . $title_val. '-'.$request->input('author_name')[$key] .'<br>';
            $publisher_exists = Publisher::where('publisher_name',$request->input('publisher_name')[$key])
            ->get();
           
            if(isset($publisher_exists)){
                $publisher->publisher_name = $request->input('publisher_name')[$key];
                $publisher->publisher_add = $request->input('publisher_address')[$key];
                $publisher->save();
                
            }
        }

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
    public function edit($id)
    {
        //
        $purchase_requests = PurchaseRequest::findOrfail($id);

        $purchase_request_recommended_users = PurchaseRequestRecommendedUser::all();
        $purchase_request_approver_users = PurchaseRequestApproverUser::all();

        $role_name = DB::table('roles')
            ->where('id',Auth::user()->role)
            ->get()
            ->first();

        $department_name = DepartmentName::join('employees','employees.department_names_id','=','department_names.id')
        ->select('department_names.department_name')
        ->where('employees.users_id','=',Auth::user()->id)
        ->get()
        ->first();

        $department_name_list = DepartmentName::where('deleted_flag','=',0)
        ->orderBy('department_name','asc')
        ->get();
        return view('purchase_requests.edit',[
            'purchase_request' => $purchase_requests,
            'purchase_request_recommended_users' => $purchase_request_recommended_users,
            'purchase_request_approver_users' => $purchase_request_approver_users,
            'role_name' => collect($role_name)['name'],
            'department_name' => $department_name,
            'department_name_list' => $department_name_list,
        ]);
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
    public function destroy($id)
    {
        //
        $purchase_requests = PurchaseRequest::findOrfail($id);
        $purchase_requests->deleted_flag = 1;
        $purchase_requests->update();
        return redirect()->route('purchase_request.index')->withError('Deleted Successfully ' .$purchase_requests->title);
    }

    public function delete($id){
        $purchase_requests = PurchaseRequest::findOrfail($id);
        $purchase_requests->deleted_flag = 1;
        $purchase_requests->update();
        return redirect()->route('purchase_request.index')->withError('Deleted Successfully ' .$purchase_requests->title);
    }

    public function requested_books_edit($id){
        $signature = SignatureAttachment::where('users_id','=',Auth::user()->id)
        ->get()
        ->first();

        $purchase_requests = PurchaseRequest::findOrfail($id);

        $purchase_request_recommended_users = PurchaseRequestRecommendedUser::all();
        $purchase_request_approver_users = PurchaseRequestApproverUser::all();

        $role_name = DB::table('roles')
            ->where('id',Auth::user()->role)
            ->get()
            ->first();

        $department_name = DepartmentName::join('employees','employees.department_names_id','=','department_names.id')
        ->select('department_names.department_name')
        ->where('employees.users_id','=',Auth::user()->id)
        ->get()
        ->first();

        $department_name_list = DepartmentName::where('deleted_flag','=',0)
        ->orderBy('department_name','asc')
        ->get();

        // $purchase_by_department = User::join('purchase_requests','purchase_requests.created_by_users_id','=','users.id')
        // ->select('purchase_requests.created_at')
        // ->where('year(purchase_requests.created_at)','=',date('Y'))
        // ->get();
        // dd($purchase_by_department);

        $budget = DepartmentBudget::join('department_names','department_names.id','=','department_budgets.department_name_id')
        ->select('department_budgets.no_of_students','department_budgets.amount')
        ->where('department_budgets.deleted_flag','=',0)
        ->where('department_names.department_name','=',explode(",",$purchase_requests->charge_to)[0])
        ->where('department_budgets.school_year','=',date('Y').'-'.(date('Y')+1))
        ->get()
        ->last();

        $budgetAll = DepartmentBudget::join('department_names','department_names.id','=','department_budgets.department_name_id')
        ->select('department_budgets.*','department_names.department_name')
        ->where('department_budgets.deleted_flag','=',0)
        ->where('department_names.department_name','!=',explode(",",$purchase_requests->charge_to)[0])
        ->where('department_budgets.school_year','=',date('Y').'-'.(date('Y')+1))
        ->get();

        $department_budget_left = PurchaseRequest::where('department_names_id',$purchase_requests->department_names_id)
        ->where('deleted_flag','=',0)
        ->sum('amount');

        // dd(floatval($budget->no_of_students * $budget->amount)-floatval($department_budget_left));

        return view('purchase_requests.requested_books',[
            'purchase_request' => $purchase_requests,
            'purchase_request_recommended_users' => $purchase_request_recommended_users,
            'purchase_request_approver_users' => $purchase_request_approver_users,
            'role_name' => collect($role_name)['name'],
            'department_name' => $department_name,
            'department_name_list' => $department_name_list,
            'signature' => $signature,
            'budget' => $budget,
            'budget_all' => $budgetAll,
            'department_budget_left' => floatval($department_budget_left)
        ]);
    }

    public function requested_books_update(Request $request){
        $purchase_requests = PurchaseRequest::findOrfail($request->purchase_request_id);
        $department_name = DepartmentName::findOrfail($request->dept_budgets_id);

        if($request->amountToBorrowed != 0){
            $budget_borroweds = new BudgetBorrow();
            $budget_borroweds->created_by_users_id = Auth::user()->id;
            $budget_borroweds->dept_names_id = $request->dept_budgets_id;
            $budget_borroweds->dept_budgets_id = $request->dept_budgets_id;
            $budget_borroweds->amount = $request->amountToBorrowed;
            $budget_borroweds->remarks = "Borrowed from ". $department_name->department_name;
            $budget_borroweds->save();
        }

        if($purchase_requests->status_id == 2){
            $purchase_requests->book_price = implode(',',$request->input('amount'));
            $purchase_requests->amount = $request->input('totalBookPrice_amount');
            $purchase_requests->status_id = 3;
        }

        if($purchase_requests->status_id == 4 && $request->input('totalBookPrice_amount') < 50000){
            $purchase_requests->status_id = ($purchase_requests->status_id + 2);
            $purchase_requests->update();
            return redirect()->route('purchase_request.index')->withStatus('Request Approved.');
        }
        
        $purchase_requests->status_id = ($purchase_requests->status_id + 1);
        $purchase_requests->update();
        return redirect()->route('purchase_request.index')->withStatus('Request Approved.');
    }
}
