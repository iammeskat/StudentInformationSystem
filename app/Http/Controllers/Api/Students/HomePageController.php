<?php

namespace App\Http\Controllers\Api\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Student;
use App\Models\Post;
use App\Models\PostFor;

class HomePageController extends Controller
{
    public function posts(Request $request){

    	$user_id = $request->user()->id;
    	$student = Student::where('user_id', $user_id)->first();
    	$posts = PostFor::where('all', 1)
    					->orWhere('student', 1)
    					->orWhere('semester', $student->semester)
    					->orWhere('batch', $student->batch)
    					->get();

    	return response()->json([
    		'data' => $posts,
    		'error' => 'false',
    	]);
    }
}
