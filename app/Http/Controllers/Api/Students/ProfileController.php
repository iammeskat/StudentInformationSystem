<?php

namespace App\Http\Controllers\Api\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Student;
use App\Models\User;

class ProfileController extends Controller
{
	/**
     * Student profile
     * @return json
     */
    public function profile(){
    	$user_id = 4; // access token diye auth theke nite hobe
    	$student = Student::with('user')->where('user_id', $user_id)->first();
    	return response()->json([
    		'data' => $student,
    		'error' => 'false',
    	]);
    }

    /**
     * Student profile update
     * @return json
     */
    public function update(Request $request){
    	$id = 4; // access token diye auth theke nite hobe

    	$validator = Validator::make($request->all(), [
            'name' => 'required|max:55',
            'batch' => 'required',
            'semester' => 'required',
            'advisor_id' => 'required|numeric',
            'phone_number' => 'required|max:15|min:11',
            'email' => 'email|required',
            'password' => 'required|min:8|confirmed',
            'image' => 'image|max:2048',
        ]);
        if($validator->fails()){
            return response()->json([
                'message'=>'Validation Failed',
                'errors'=>$validator->errors()->all(),
                'data'=>$request->input(),
                'error' => 'true',
            ]);
        }

        $image = $request->file('image');
        $image_path = '';
        if($image){
            if($image->isValid()){
                $image_path = $request->image->storeAs('users', $image->getClientOriginalName());
            }
        }

        $student = Student::with('user')->find($id);
        $user = User::find($student->user_id);
        $user->update([
        	'phone_number' => $request->phone_number,
            'email' => strtolower(trim($request->email)),
            'password' => bcrypt($request->password),
            'picture_path' => $image_path,
        ]);

        $student->update([
            'name' => $request->name,
            'batch' => $request->batch,
            'semester' => $request->semester,
            'advisor_id' => $request->advisor_id,
            
        ]);

        return response()->json([
            'data'=> $student,
            'error' => 'false',
        ]);

    }
}
