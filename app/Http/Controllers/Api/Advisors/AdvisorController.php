<?php

namespace App\Http\Controllers\Api\Advisors;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Advisor;
use App\Models\StudentsEnroll;

class AdvisorController extends Controller
{
	/**
     * student list
     * @return json 
     */
    public function studentList(Request $request){
    	$user_id = $request->user()->id;
    	$teacher_id = Teacher::where('user_id', $user_id)->first()->id;
    	$advisor_id = Advisor::where('teacher_id', $teacher_id)->first()->id;
    	//return $advisor_id;
    	$students = User::leftjoin('students', 'students.user_id', 'users.id')
    						->select('students.id', 'students.user_id', 'students.name', 'students.student_id',
    								'students.batch', 'students.semester', 'users.email', 'users.phone_number')
    						->where('advisor_id', $advisor_id)
    						->get();
    	return response()->json([
    		'data' => $students,
    		'error' => 'false',
    	]);
    }

    /**
     * Enroll request
     * @return json 
     */
    public function enrollRequests(Request $request){
    	$user_id = $request->user()->id;
    	$teacher_id = Teacher::where('user_id', $user_id)->first()->id;
    	$advisor_id = Advisor::where('teacher_id', $teacher_id)->first()->id;

    	$enrollRequests = StudentsEnroll::leftjoin('students', 'students.id', 'students_enrolls.student_id')
    									->select('students.id', 'students.user_id', 'students.student_id', 'students.name')
    									->where('advisor_id', $advisor_id)
    									->where('status', 0)
    									->distinct()
    									->get();

    	return response()->json([
    		'data' => $enrollRequests,
    		'error' => 'false',
    	]);
    }

    /**
     * list of requested subject
     * @return json 
     */
    public function requestedSubject($id){ // $id = students.id
    	$requestedSubjects = StudentsEnroll::where('student_id', $id)->get();
    	return response()->json([
    		'data' => $requestedSubjects,
    		'error' => 'false',
    	]);
    }

    /**
     * approve request
     * @return json 
     */
    public function approve($id){  // $id = students.id

    	$enrolledSubjects = StudentsEnroll::where('student_id', $id)->get();

    	foreach ($enrolledSubjects as $subject) {
    		$subject->update(['status' => 1]);
    	}

    	return response()->json([
    		'message' => 'Approved',
    		'error' => 'false',
    	]);
    }
}
