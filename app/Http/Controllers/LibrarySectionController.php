<?php

namespace App\Http\Controllers;

use App\Models\LibrarySection;
use Illuminate\Http\Request;

class LibrarySectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permission:library_section-list', ['only' => ['index']]);
        $this->middleware('permission:library_section-create', ['only' => ['create','store']]);
        $this->middleware('permission:library_section-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:library_section-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        //
        $library_section = LibrarySection::where('deleted_flag','=',0)
        ->orderBy('section_name','asc')
        ->get();
        return view('library_sections.index',[
            'library_section' => $library_section
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
        return view('library_sections.create');
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
        $library_section = new LibrarySection();
        $data = $request->except('_token');
        //$data['department_name_id'] = $department_name->id;
        $library_section->create($data);

        return redirect()->route('library_section.index')->withStatus("Successfully Added.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LibrarySection  $librarySection
     * @return \Illuminate\Http\Response
     */
    public function show(LibrarySection $librarySection)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LibrarySection  $librarySection
     * @return \Illuminate\Http\Response
     */
    public function edit(LibrarySection $librarySection)
    {
        //
        return view('library_sections.edit',[
            'library_section' => $librarySection
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LibrarySection  $librarySection
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LibrarySection $librarySection)
    {
        //

        $library_section = LibrarySection::findOrfail($librarySection->id);
        $data = $request->except(['_token','_method']);
        $library_section->update($data);
        return redirect()->route('library_section.index')->withStatus('Library Section Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LibrarySection  $librarySection
     * @return \Illuminate\Http\Response
     */
    public function destroy(LibrarySection $librarySection)
    {
        //
    }

    public function delete($id){
        $library_section = LibrarySection::findOrfail($id);
        $library_section->deleted_flag = 1;
        $library_section->update();
        return redirect()->route('library_section.index')->withError('Deleted Successfully ' .$library_section->section_name);
    }
}
