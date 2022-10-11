<?php

namespace App\Http\Controllers;

use App\Models\DepartmentBudget;
use App\Models\DepartmentName;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DepartmentBudgetController extends Controller
{
    function __construct()
    {       
        $this->middleware('permission:department_budget-list', ['only' => ['index','data']]);
        $this->middleware('permission:department_budget-create', ['only' => ['create','store']]);
        $this->middleware('permission:department_budget-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:department_budget-delete', ['only' => ['destroy','delete']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $budget = DepartmentBudget::join('department_names','department_names.id','=','department_budgets.department_name_id')
        ->select('department_budgets.*','department_names.department_name')
        ->where('department_budgets.deleted_flag','=',0)
        ->get();
        return view('department_budgets.index',[
            'budget' => $budget
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
        $department_name = DB::table('department_names')
            ->join('department_types','department_names.department_types_id','=','department_types.id')
            ->select('department_names.*','department_types.department_type')
            ->where('department_names.deleted_flag','=',0)
            ->orderBy('department_names.department_name','asc')
            ->get();

        return view('department_budgets.create',[
            'department_name' => $department_name
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
        $budget = new DepartmentBudget;
        $department_name = DepartmentName::where('department_name','=',$request->department_name_id)
        ->select('id')
        ->get()
        ->first();
        $data = $request->except('_token');
        $data['department_name_id'] = $department_name->id;
        $budget->create($data);

        return redirect()->route('department_budget.index')->withStatus("Successfully Added.");
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DepartmentBudget  $departmentBudget
     * @return \Illuminate\Http\Response
     */
    public function show(DepartmentBudget $departmentBudget)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DepartmentBudget  $departmentBudget
     * @return \Illuminate\Http\Response
     */
    public function edit(DepartmentBudget $departmentBudget)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DepartmentBudget  $departmentBudget
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DepartmentBudget $departmentBudget)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DepartmentBudget  $departmentBudget
     * @return \Illuminate\Http\Response
     */
    public function destroy(DepartmentBudget $departmentBudget)
    {
        //
    }

    public function delete($id)
    {
        //
    }
}
