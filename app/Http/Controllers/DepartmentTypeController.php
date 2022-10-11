<?php

namespace App\Http\Controllers;

use App\Models\DepartmentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DepartmentTypeController extends Controller
{
    function __construct()
    {       
        $this->middleware('permission:department_type-list', ['only' => ['index','data']]);
        $this->middleware('permission:department_type-create', ['only' => ['create','store']]);
        $this->middleware('permission:department_type-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:department_type-delete', ['only' => ['destroy','delete']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $permissions = DB::table('role_has_permissions')
        // ->join('permissions','permissions.id','role_has_permissions.permission_id')
        // ->where('role_id',Auth::user()->role)
        // ->select('permissions.name')
        // ->get();
        // $permissions_name = json_decode(json_encode($permissions),true)[0]['name'];
        $department_type = DepartmentType::where('deleted_flag','=',0)
        ->orderBy('department_type','asc')
        ->get();
        return view('department_types.index',[
            'department_type' => $department_type
        ]);
    }

    public function data(){
        $department_type = DepartmentType::all();
        return response()->json([
            'data' => $department_type,
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
        return view('department_types.create');
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
        $department_type = new DepartmentType();
        $is_exists = $department_type->where('department_type','=',$request->department_type);
        if($is_exists->count() == 0){
            $this->save($department_type,$request);
            return redirect()->route('department_type.index')->withStatus('Created Successfully');
        }else{
            return redirect()->back()->withError('Data already exists ' .$request->department_type);
        }
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DepartmentType  $departmentType
     * @return \Illuminate\Http\Response
     */
    public function show(DepartmentType $departmentType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DepartmentType  $departmentType
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $department_type = DepartmentType::findOrfail($id);
        return view('department_types.edit',[
            'department_type' => $department_type
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DepartmentType  $departmentType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $department_type = DepartmentType::findOrfail($id);
        $this->save($department_type,$request);

        return redirect()->route('department_type.index')->withStatus('Updated Successfully');
    }

    //Refractor duplicate codes
    public function save(DepartmentType $departmentType, Request $request){
        $departmentType->created_by_users_id = Auth::user()->id;
        $departmentType->department_type = $request->department_type;
        if(strtoupper($request->_method) == "PUT")
            $departmentType->update();
        else
            $departmentType->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DepartmentType  $departmentType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $department_type = DepartmentType::findOrfail($id);
        $department_type->deleted_flag = 1;
        $department_type->update();
        return redirect()->route('department_type.index')->withError('Deleted Successfully ' .$department_type->department_type);
    }

    public function delete($id){
        $department_type = DepartmentType::findOrfail($id);
        $department_type->deleted_flag = 1;
        $department_type->update();
        return redirect()->route('department_type.index')->withError('Deleted Successfully ' .$department_type->department_type);
    }
}
