<?php

namespace App\Http\Controllers\Api\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Courses;

class CourseController extends Controller
{
	/**
     * Course list
     * @return json 
     */
    public function index(){
    	$courses = Courses::all();
    	return response()->json([
    		'data' => $courses,
    		'error' => 'false',
    	]);

    }

    /**
     * Create course
     * @return json
     */
    public function create(Request $request){
    	$validator = Validator::make($request->all(), [
            'course_code' => 'required|unique:courses',
            'name' => 'required',
            'semester' => 'required',
            'type' => 'required',
            'credit' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'message'=>'Validation Failed',
                'errors'=>$validator->errors()->all(),
                'data'=>$request->input(),
            ]);
        }

        $course = Courses::create([
        	'course_code' => $request->course_code,
        	'name' => $request->name,
        	'semester' => $request->semester,
        	'type' => $request->type,
        	'credit' => $request->credit,
        ]);

        return response()->json([
    		'data' => $course,
    		'error' => 'false',
    	]);
    }

    /**
     * Update course
     * @return json
     */
    public function update(Request $request, $id){
    	$validator = Validator::make($request->all(), [
            'course_code' => 'required',
            'name' => 'required',
            'semester' => 'required',
            'type' => 'required',
            'credit' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'message'=>'Validation Failed',
                'errors'=>$validator->errors()->all(),
                'data'=>$request->input(),
            ]);
        }

        $course = Courses::find($id);
        $res = $course->update([
        	'course_code' => $request->course_code,
        	'name' => $request->name,
        	'semester' => $request->semester,
        	'type' => $request->type,
        	'credit' => $request->credit,
        ]);

        return response()->json([
    		'data' => $course,
    		'error' => !$res,
    	]);
    }

    /**
     * show course
     * @return json
     */
    public function show($id){
    	$course = Courses::find($id);
    	return response()->json([
    		'data' => $course,
    		'error' => 'false',
    	]);
    }

    /**
     * delete course
     * @return json
     */
    public function destroy($id){
    	$course = Courses::find($id);
    	return response()->json([
    		'data' => $course,
    		'error' => !$course->delete(),
    	]);
    }
}
