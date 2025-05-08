<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    function list()
    {
        return Student::all();
    }
    function addStudent(Request $request)
    {
        $rules= array(
            'name'=> 'required | min:2 | max:10',
            "email"=>'email | required',
            "phone"=>"required"
        );
        $validation = Validator::make($request->all(), $rules);
        if ($validation->fails()) {
            return $validation->errors();
        }
        else{
            $student = new Student();
        $student->name=$request->name;
        $student->email=$request->email;
        $student->phone=$request->phone;
        
        if($student->save()){
            return "Student added";
        }
        else{
            return "operation failed";
        }

        }

        
    }
    function updateStudent(Request $request)
    {
    
        $student= Student::find($request->id);
        $student->name= $request->name;
        $student->email= $request->email;
        $student->phone= $request->phone;
        if($student->save()){
            return ["result"=>" student updated"];
       }
        else{
            return ["result"=>" student not updated"];
        }
    }
    function deleteStudent($id)
    {
        $student = Student::destroy($id);
        if($student){
            return ['result'=>"student record deleted"];
        }
        else{
            return ['result'=>"student record not deleted"];
        }
    }
    function searchStudent($name)
    {
        $student= Student::where('name','like',"%$name%")->get();
        if($student){
            return ['result'=>$student];
        }
        else{
            return ['result'=>"no record found"];
        }
        
    }

}
