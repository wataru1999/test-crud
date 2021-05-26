<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//qb
        $students = DB::table('students')->paginate(3);
//e=m        
        $students1 = Student::get();

         $message = "cute";
        return view('students', [

        "students" => $students,
        "students1" => $students1,
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
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // query builder
        DB::table('students')->insert([
            'first_name' => $request->input('inputFirstname'),
            'last_name' => $request->input('inputLastname'),
            'section' => $request->input('inputSection'),
        ]);
        return redirect('students');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
       
        $affected = DB::table('students')
              ->where('student_id', $request->input('editStudentID'))
              ->update([
                  'first_name' => $request->input('editFirstname'),
                  'last_name' => $request->input('editLastname'),
                  'section' => $request->input('editSection'),
                  ]);

              return redirect('students');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy($student_id)
    {
        //
        DB::table('students')->where('student_id', '=', $student_id)->delete();
        return redirect('students');
    }
}
