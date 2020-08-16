<?php

namespace App\Http\Controllers\Api\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;

class UserController extends Controller
{
    public function register(Request $request)
    {
        
        $validatedData = $request->validate([
        	'student_id' => 'required|max:13',
            'name' => 'required|max:55',
            'department' => 'required',
            'batch' => 'required',
            'semester' => 'required',
            'advisor_id' => 'required|integer',
            'phone_number' => 'required|max:15|min:11',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed'
        ]);
        
        $validatedData['password'] = bcrypt($request->password);
        $validatedData['email_verification_token'] = $request->email.Str::random(55);
        $validatedData['status'] = 'inactive';
        $user = User::create($validatedData);
        $accessToken = $user->createToken('authToken')->accessToken;
        return json_encode([
            'data'=>[
                'user' => $user,
                'access_token' => $accessToken
            ],
            'message'=>'successfully retrieved'
        ]);
    }
}
