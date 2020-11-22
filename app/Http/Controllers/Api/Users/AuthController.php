<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Notifications\verifyEmail;
use App\Models\User;
use App\Models\Student;

class AuthController extends Controller
{

    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'student_id' => 'required|numeric|digits:13|unique:students',
            'name' => 'required|max:55',
            'department' => 'required',
            'batch' => 'required',
            'semester' => 'required',
            'advisor_id' => 'required|numeric',
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
        	'phone_number' => $request->phone_number,
            'email' => strtolower(trim($request->email)),
            'password' => bcrypt($request->password),
            'email_verification_token' => $request->email.Str::random(55),
            'picture_path' => $image_path,
            'status' => 'inactive',
        ]);

        $student = Student::create([
            'user_id' => $user->id,
            'student_id' => $request->student_id,
            'name' => $request->name,
            'department' => $request->department,
            'batch' => $request->batch,
            'semester' => $request->semester,
            'advisor_id' => $request->advisor_id,
            
        ]);

        $accessToken = $user->createToken('authToken')->accessToken;
        #$user->notify(new verifyEmail($user));
        unset($user['email_verification_token']);
        return response()->json([
            'data'=>[
                'user' => $user,
                'student' => $student,
                'access_token' => $accessToken
            ],
            'message'=>'successfully retrieved'
        ]);
    }

    /**
     * User Login
     * @return json
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if($validator->fails()){
            return response()->json([
                'errors'=>$validator->errors()->all(),
                'data'=>$request->input(),
                'message'=>'Validation Failed',
            ]);
        }
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (!auth()->attempt($credentials)) { 
            return response()->json([
                'message' => 'Invalid Credentials',
                'data'=>$request->input(),
            ]);
        }
        
        $user = auth()->user();
        if($user->email_verified == 0){
            auth()->logout();
            return response()->json(['message' => 'Your account is not activated. Please verify your email.']);
        }
        if($user->status == 'inactive'){
            auth()->logout();
            return response()->json(['message' => 'Your account is not activated. Waiting for advisor approval.']);
        }
        $accessToken = auth()->user()->createToken('authToken')->accessToken;
        return response()->json([
            'data'=>[
                'user' => $user,
                'access_token' => $accessToken
            ],
            'message'=>'successfully retrieved'
        ]);

    }
}
