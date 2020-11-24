<?php

namespace App\Http\Controllers\Api\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\User;

class StudentController extends Controller
{
    /**
     * Students list
     * @return json
     */
    public function index(){
    	$data = Student::with('user', 'advisor')->get();

    	return response()->json([
            'data'=> $data,
            'error'=>'false'
        ]);
    }

    /**
     * Pending list
     * @return json
     */
    public function pendingList(){
    	$data = User::where('status', 0)->where('user_type', 'student')->get();
    	return response()->json([
            'data'=> $data,
            'error'=>'false'
        ]);
    }

    /**
     * Account approve
     * @return json
     */
    public function approve($id){
    	$user = User::find($id);
    	$res = $user->update(['status'=>1]);
    	return response()->json([
            'error'=>!$res,
        ]);
    }

    /**
     * show
     * @return json
     */
    public function show($id){
        $student = Student::with('user', 'advisor')->find($id);
        return response()->json([
            'data' => $student,
            'error'=> 'false',
        ]);
    }

    /**
     * Remove teacher
     * @return json
     */
    public function destroy($id){
    	$student = Student::find($id);
    	$user_id = $student->user_id;

        if($student->delete()){
            if(User::find($user_id)->delete()){
                return response()->json([
                    'error'=> 'false',
                ]);
            }
            return response()->json([
                'error'=> 'true',
            ]);
        }

        return response()->json([
            'error'=> 'true',
        ]);
    }
}
