<?php

namespace App\Http\Controllers;

use App\Models\DepartmentName;
use App\Models\DepartmentType;
use Illuminate\Http\Request;

class DepartmentNameController extends Controller
{
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
        $department_type = DepartmentType::all();
        return response()->json($department_type);
        // return response()->json([
        //     'data' => $department_type,
        // ]);
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
    public function edit(DepartmentName $departmentName)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DepartmentName  $departmentName
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DepartmentName $departmentName)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DepartmentName  $departmentName
     * @return \Illuminate\Http\Response
     */
    public function destroy(DepartmentName $departmentName)
    {
        //
    }
}
