<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\DepartmentName;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    function __construct()
    {       
        $this->middleware('permission:employee-list', ['only' => ['index','data']]);
        $this->middleware('permission:employee-create', ['only' => ['create','store']]);
        $this->middleware('permission:employee-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:employee-delete', ['only' => ['destroy','delete']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $employees = DB::table('employees')
        ->join('users','users.id','=','employees.users_id')
        ->join('department_names','department_names.id','=','employees.department_names_id')
        ->join('roles','roles.id','=','users.role')
        ->select('employees.*','users.name','roles.name as rolename','department_names.department_name')
        ->where('employees.deleted_flag','=',0)
        ->orderBy('employees.emp_lastname','asc')
        ->get();
       
        return view('employees.index',[
            'employees' => $employees
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
        $department_names = DepartmentName::where('deleted_flag','=',0)
        ->orderBy('department_name','asc')
        ->get();
        $users = User::where('role','>',3)
        ->select('users.*')
        ->whereNotExists(function($query){
            $query->select('emp.users_id')
            ->from('employees AS emp')
            ->whereColumn('emp.users_id','users.id');
        })
        ->get();
        $user_faculty_and_admin = User::whereIn('role', [9, 10])->get();
       
        return view('employees.create',[
            'department_names' => $department_names,
            'users' => $users,
            'user_faculty_and_admin' => count($user_faculty_and_admin),
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
        $employees = new Employee();
        $is_exists = DB::table('employees')
        ->where('emp_idnum','=',$request->emp_idnum);
        if($is_exists->count() == 0){
            $data = $request->except('_token');
            $employees::create($data);
            return redirect()->route('employee.index')->withStatus('Created Successfully');
        }else{
            return redirect()->back()->withError('Data already exists ' .$request->emp_idnum);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $employees = Employee::findOrfail($id);
        $department_names = DepartmentName::all();
        $users = User::where('role','>',3)
        ->get();
        
        return view('employees.edit',[
            'employees' => $employees,
            'department_names' => $department_names,
            'users' => $users,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $data = $request->except(['_token','_method']);
        DB::table('employees')->update($data);
        return redirect()->route('employee.index')->withStatus('Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        //
    }

    public function delete($id){
        $employees = Employee::findOrfail($id);
        $employees->deleted_flag = 1;
        $employees->update();
        return redirect()->route('employee.index')->withError('Deleted Successfully ' .$employees->emp_idnum);
    }
}
