<?php

namespace App\Http\Controllers\Api\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Post;
use App\Models\PostFor;

class PostController extends Controller
{
    /**
     * Posts list
     * @return json
     */
    public function allPost(){
    	$posts = Post::with('post_for')->get();

    	return response()->json([
    		'data' => $posts,
    		'error' => 'false',
    	]);
    }

    /**
     * Admins Post
     * @return json
     */
    public function myPost(){
    	$admin_id = 3;   // test
    	$posts = Post::where('user_id', $admin_id)->with('post_for')->get();

    	return response()->json([
    		'data' => $posts,
    		'error' => 'false',
    	]);
    }

    /**
     * Create post
     * @return json
     */
    public function createPost(Request $request){
    	$validator = Validator::make($request->all(), [
            'content' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'message'=>'Validation Failed',
                'errors'=>$validator->errors()->all(),
                'data'=>$request->input(),
            ]);
        }

        $admin_id = 3;
        $post = Post::create([
            'user_id' => $admin_id,		// test
        	'content' => $request->content,
            'status' => '1',
        ]);

        $post_for = PostFor::create([
        	'post_id' => $post->id,
        	'all' => $request->all,
        	'student' => $request->student,
        	'teacher' => $request->teacher,
        ]);

        return response()->json([
    		'data' => $request->input(),
    		'error' => 'false',
    	]);
    }
}
