<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class StudentController extends Controller
{

    public function index(Request $request)
    {
        if($request->query('search')) {
            return $this->search($request);
        }

        $students = Student::paginate(2);

        return response()->json($students);
    }


    public function store(StoreStudentRequest $request)
    {

        $fileExtension = $request->file('image')->extension();

        $storeExtension =  time() . '.' . $fileExtension;

        $request->file('image')->storeAs('public/img', $storeExtension);

        Student::create([
            'name'  => $request->name,
            'email' => $request->email,
            'image' => $storeExtension
        ]);

        $students = Student::paginate(2);

        return response()->json($students);
    }

    public function update(UpdateStudentRequest $request)
    {

        $student = Student::find($request->id);

        $oldImage = $student->image;

        $save = [
            'name'   => $request->name,
            'email'  => $request->email,
            'image'  => $oldImage
        ];

        if ($request->hasFile('image')) {

            $file = public_path('storage/img', $oldImage);

            File::delete($file);

            $fileExtension = $request->file('image')->extension();

            $storeExtension =  time() . '.' . $fileExtension;

            $request->file('image')->storeAs('public/img', $storeExtension);

            $save['image'] = $storeExtension;
        }

        DB::table('students')->where('id', $request->id)->update($save);

        $students = Student::paginate(2);

        return response()->json($students);
    }

    public function destroy($id)
    {
        $student = Student::find($id);
        if ($student) {

            $file = public_path() . '/storage/img/' . $student->image;

            Student::destroy($id);

            File::delete($file);

            return response()->json('Successfully Deleted', 200);
        }

        return response()->json('Not Found User', 500);
    }

    public function search(Request $request)
    {
        $search = $request->query('search');

        $students = Student::where('name','LIKE','%'.$search.'%')->orWhere('email','LIKE','%'.$search.'%')->paginate(2);

        return response()->json($students);

    }
}
