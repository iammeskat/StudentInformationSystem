<?php

namespace App\Http\Controllers\Api\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\StudentsEnroll;
use App\Models\Student;
use App\Models\Courses;
use App\Models\User;

class EnrollmentController extends Controller
{
	/**
     * Course list
     * @return json
     */
	public function courses(){
		
		return response()->json([
            'data'=> Courses::all(),
            'error' => 'false',
        ]);
	}

	/**
     * My course
     * @return json
     */
	public function myCourses(Request $request){
		$user_id = $request->user()->id;
		$student_id = Student::where('user_id', $user_id)->first()->id;
		$courses = StudentsEnroll::where('student_id', $student_id)->get();
		return response()->json([
            'data'=> $courses,
            'error' => 'false',
        ]);
	}
	/**
     * Student enroll
     * @return json
     */
    public function studentEnroll(Request $request){
    	
    	$validator = Validator::make($request->all(), [
            'course_id' => 'required',
            'session' => 'required',
            'semester' => 'required',
        ]);
        if($validator->fails()){
            return response()->json([
                'message'=>'Validation Failed',
                'errors'=>$validator->errors()->all(),
                'data'=>$request->input(),
                'error' => 'true',
            ]);
        }

        $user_id = $request->user()->id;
        $enroll = StudentsEnroll::create([
        	'student_id' => Student::select('id')->where('user_id', $user_id)->first()->id,
        	'course_id' => $request->course_id,
        	'session' => $request->session,
        	'semester' => $request->semester,
        	'status' => 0,
        ]);

        return response()->json([
            'data'=> $enroll,
            'error' => 'false',
        ]);
    }
}
