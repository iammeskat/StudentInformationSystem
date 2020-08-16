<?php

namespace App\Http\Controllers\Api\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Validator;
use App\Models\User;

class UserController extends Controller
{
    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'student_id' => 'required|max:13|unique:users',
            'name' => 'required|max:55',
            'department' => 'required',
            'batch' => 'required',
            'semester' => 'required',
            'advisor_id' => 'required|integer',
            'phone_number' => 'required|max:15|min:11',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed'
        ]);
        if($validator->fails()){
            return response()->json([
                'message'=>'Validation Failed',
                'errors'=>$validator->errors()->all(),
                'data'=>$request->input(),
            ]);
        }
        
        $user = User::create([
            'student_id' => $request->student_id,
            'name' => $request->name,
            'department' => $request->department,
            'batch' => $request->batch,
            'semester' => $request->semester,
            'advisor_id' => $request->advisor_id,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'email_verification_token' => $request->email.Str::random(55),
            'status' => 'inactive',
        ]);

        $accessToken = $user->createToken('authToken')->accessToken;
        return response()->json([
            'data'=>[
                'user' => $user,
                'access_token' => $accessToken
            ],
            'message'=>'successfully retrieved'
        ]);
    }
}
