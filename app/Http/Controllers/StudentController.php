<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{   

    public function index() 
    {

       $students = Student::all();
       
       return response()->json($students);
    }

    public function store(StoreStudentRequest $request) {
        
        Student::create([
            'name'  => $request->name,
            'email' => $request->email,
        ]);

        $students = Student::all();

        return response()->json($students);
    }

    public function destroy($id) {
       $student = Student::find($id);
       if($student) {
            Student::destroy($id);
            return response()->json('Succefully Deleted',200);
       }

       return response()->json('Not Found User',500);
    }
}
