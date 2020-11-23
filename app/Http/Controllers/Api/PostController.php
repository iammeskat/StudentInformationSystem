<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Post;
use App\Models\PostFor;
use App\Models\User;

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
    public function myPost(Request $request){
    	$user_id = $request->user()->id;
    	$posts = Post::where('user_id', $user_id)->with('post_for')->get();

    	return response()->json([
    		'data' => $posts,
    		'error' => 'false',
    	]);
    }

    /**
     * View specific Post
     * @return json
     */
    public function show($id){
    	$post = Post::with('post_for')->find($id);
    	return response()->json([
    		'data' => $post,
    		'error' => 'false',
    	]);
    }

    /**
     * Create post
     * @return json
     */
    public function create(Request $request){
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

        $user_id = $request->user()->id;
        $post = Post::create([
            'user_id' => $user_id,		// test
        	'content' => $request->content,
            'status' => '1',
        ]);

        $post_for = PostFor::create([
        	'post_id' => $post->id,
        	'all' => $request->all,
        	'student' => $request->student,
        	'teacher' => $request->teacher,
        	'batch' => $request->batch,
        	'semester' => $request->semester,
        ]);

        return response()->json([
    		'data' => Post::with('post_for')->find($post->id),
    		'error' => 'false',
    	]);
    }

    /**
     * Update post
     * @return json
     */
    public function update(Request $request, $id){
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

        $post = Post::find($id);
        $post->update([
        	'content' => $request->content,
        ]);

        $postFor = PostFor::where('post_id', $post->id);
        $postFor->update([
        	'all' => $request->all,
        	'student' => $request->student,
        	'teacher' => $request->teacher,
        ]);

        $post = Post::with('post_for')->find($post->id);
        return response()->json([
    		'data' => $post,
    		'error' => 'false',
    	]);
    }

    /**
     * delete post
     * @return json
     */
    public function destroy($id){
    	$post = Post::find($id);
    	if(PostFor::where('post_id', $post->id)->delete()){
    		if($post->delete()){
    			return response()->json([
		    		'data' => $post,
		    		'error' => 'false',
		    	]);
    		}
    		return response()->json([
	    		'data' => $post,
	    		'error' => 'true',
	    	]);
    	}

    	return response()->json([
    		'data' => $post,
    		'error' => 'true',
    	]);
    }
}
