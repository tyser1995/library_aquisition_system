<?php

namespace App\Http\Controllers;

use App\Models\DepartmentName;
use App\Models\DepartmentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Query\Builder;

class DepartmentNameController extends Controller
{
    function __construct()
    {       
        $this->middleware('permission:department_name-list', ['only' => ['index','data']]);
        $this->middleware('permission:department_name-create', ['only' => ['create','store']]);
        $this->middleware('permission:department_name-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:department_name-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('department_names.index');
    }

    public function data(){
        $department_name = DB::table('department_names')
            ->join('department_types','department_names.department_types_id','=','department_types.id')
            ->select('department_names.*','department_types.*')
            ->get();
        // return response()->json($department_name);
        return response()->json([
            'data' => $department_name,
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
        $department_type = DepartmentType::all();
        return view('department_names.create',[
            'department_type' => $department_type
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
        $department_name = new DepartmentName();
        $is_exists = DB::table('department_names')
        ->where('department_name','=',$request->department_name)
        ->where('department_code','=',$request->department_code);
        if($is_exists->count() == 0){
            $data = $request->except('_token');
            $department_name::create($data);
            return redirect()->route('department_name.index')->withStatus('Created Successfully');
        }else{
            return redirect()->back()->withError('Data already exists ' .$request->department_name);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DepartmentName  $departmentName
     * @return \Illuminate\Http\Response
     */
    public function show(DepartmentName $departmentName)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DepartmentName  $departmentName
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $department_type = DepartmentType::all();
        $department_name = DepartmentName::findOrfail($id);
        $department_name_join = DB::table('department_names')
        ->join('department_types','department_types.id','=','department_names.department_types_id')
        ->select('department_names.department_types_id')
        ->where('department_names.id',$id)
        ->get()
        ->first();
        return view('department_names.edit',[
            'department_type' => $department_type,
            'department_name' => $department_name,
            'department_name_join' => $department_name_join,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DepartmentName  $departmentName
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        //$department_name = new DepartmentName();
        $data = $request->except(['_token','_method']);
        DB::table('department_names')->update($data);
        return redirect()->route('department_name.index')->withStatus('Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DepartmentName  $departmentName
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $department_name = DepartmentName::findOrfail($id);
        $department_name->delete();
        return redirect()->route('department_name.index')->withError('Deleted Successfully ' .$department_name->department_name);
    }

    public function delete($id){
        $department_name = DepartmentName::findOrfail($id);
        $department_name->delete();
        return redirect()->route('department_name.index')->withError('Deleted Successfully ' .$department_name->department_name);
    }
}
