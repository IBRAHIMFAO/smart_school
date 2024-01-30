<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Imports\GroupImport;
use Maatwebsite\Excel\Facades\Excel;

use App\Models\Group;
use App\Models\Student;
use App\Models\Seance;
use App\Models\Filiere;

use App\Models\Attendance;
use App\Exports\AttendanceExport;




class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = Group::all();
        return view('groups.index', compact('groups'));
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
        $group = Group::find($id);
        $students= Student::where('code_group',$id)->get();
        // $students = $group->student;
        return view('groups.show', compact('group', 'students'));
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

    public function export()
{
    // $attendance = Attendance::all(); // Fetch the attendance data from the database

    // return Excel::download(new AttendanceExport($attendance), 'attendance.xlsx');
    return Excel::download(new AttendanceExport, 'exportGroup.xlsx');

}

    public function import (Request $request)
    {
        $request->validate([
            'import_file' => 'required|mimes:xlsx,xls',
        ]);

        Excel::import(new GroupImport, $request ->file('import_file'));
        return redirect()->back()->with('success', 'All good!');
        // return 'succes';

        // $file = $request->file('file');
        // Excel::import(new AttendanceImport, $file);
        // return redirect()->back()->with('success', 'All good!');
    }
}
