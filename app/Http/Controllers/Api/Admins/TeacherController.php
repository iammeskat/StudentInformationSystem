<?php

namespace App\Http\Controllers\Api\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Notifications\verifyEmail;
use App\Models\Teacher;
use App\Models\User;

class TeacherController extends Controller
{
    /**
     * Teachers list
     * @return json
     */
    public function index(){
    	$data = Teacher::with('user')->get();

    	return response()->json([
            'data'=> $data,
            'error' => 'false',
        ]);
    }

    /**
     * Add teacher
     * @return json
     */
    public function addTeacher(Request $request){

    	$validator = Validator::make($request->all(), [
            'teacher_id' => 'required|numeric|digits:9|unique:teachers',
            'name' => 'required|max:55',
            'department' => 'required',

            'phone_number' => 'required|max:15|min:11|unique:users',
            'email' => 'email|required|unique:users',
            'password' => 'required|min:8|confirmed',
            'image' => 'image|max:2048',
        ]);

        if($validator->fails()){
            return response()->json([
                'message'=>'Validation Failed',
                'errors'=>$validator->errors()->all(),
                'data'=>$request->input(),
            ]);
        }
        
        $image = $request->file('image');
        $image_path = '';
        if($image){
            if($image->isValid()){
                $image_path = $request->image->storeAs('users', $image->getClientOriginalName());
            }
        }

        $user = User::create([
            'user_type' => 'teacher',
        	'phone_number' => $request->phone_number,
            'email' => strtolower(trim($request->email)),
            'password' => bcrypt($request->password),
            'email_verification_token' => $request->email.Str::random(55),
            'picture_path' => $image_path,
            'status' => 'active',
        ]);

        if($user){
            $teacher = Teacher::create([
                'user_id' => $user->id,
                'teacher_id' => $request->teacher_id,
                'name' => $request->name,
                'department' => $request->department,
                
            ]);

            if($teacher){
                //$accessToken = $user->createToken('authToken')->accessToken;
                //$user->notify(new verifyEmail($user));
                unset($user['email_verification_token']);
                return response()->json([
                    'data'=>[
                        'user' => $user,
                        'teacher' => $teacher,
                        //'access_token' => $accessToken
                    ],
                    'message'=>'successfully retrieved'
                ]);
            }
            return response()->json([
                'data'=> $data,
                'message'=>'failed',
            ]);
        }
        return response()->json([
            'data'=> $data,
            'message'=>'failed',
        ]);
    }


    /**
     * show
     * @return json
     */
    public function show($id){
        $teacher = Teacher::with('user')->find($id);
        return response()->json([
            'data' =>  $teacher,
            'error'=> 'false',
        ]);
    }

    /**
     * Remove teacher
     * @return json
     */
    public function destroy($id){

        $teacher = Teacher::find($id);
        $user_id = $teacher->user_id;

        if($teacher->delete()){
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
