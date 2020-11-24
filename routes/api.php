<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user()->id;
});

Route::post('/register','Api\Users\AuthController@register');
Route::post('/login','Api\Users\AuthController@login');

Route::get('/verify/{token}', 'Api\Users\AuthController@verifyEmail')->name('verify');

// Admin Panel
Route::group(['prefix'=>'admin', 'middleware'=>'auth:api'], function(){

	Route::get('/teachers', 'Api\Admins\TeacherController@index');
	Route::post('/teacher/create', 'Api\Admins\TeacherController@addTeacher');
	Route::get('/teacher/{id}', 'Api\Admins\TeacherController@show');
	Route::get('/teacher/{id}/delete', 'Api\Admins\TeacherController@destroy');

	Route::get('/students', 'Api\Admins\StudentController@index');
	Route::get('/students/pending-list', 'Api\Admins\StudentController@pendingList');
	Route::get('/student/{id}', 'Api\Admins\StudentController@show');
	Route::get('/student/{id}/delete', 'Api\Admins\StudentController@destroy');
	Route::get('/student/{id}/approve', 'Api\Admins\StudentController@approve');

	Route::get('/posts', 'Api\Admins\PostController@allPost');
	Route::get('/post/my-post', 'Api\Admins\PostController@myPost');
	Route::post('/post/create', 'Api\Admins\PostController@createPost');
	Route::post('/post/{id}/update', 'Api\Admins\PostController@update');
	Route::get('/post/{id}', 'Api\Admins\PostController@show');
	Route::get('/post/{id}/delete', 'Api\Admins\PostController@destroy');

	Route::get('/courses', 'api\Admins\CourseController@index');
	Route::post('/course/create', 'api\Admins\CourseController@create');
	Route::get('/course/{id}', 'api\Admins\CourseController@show');
	Route::get('/course/{id}/delete', 'api\Admins\CourseController@destroy');
	Route::post('/course/{id}/update', 'api\Admins\CourseController@update');
});


// Student Panel
Route::group(['prefix'=>'student', 'middleware'=>'auth:api'], function(){
	
	Route::get('/', 'Api\Students\HomePageController@posts'); // all post / home page

	Route::get('/profile', 'api\Students\ProfileController@profile');
	Route::post('/profile/update', 'api\Students\ProfileController@update');

	Route::post('/post/create', 'Api\PostController@create');
	Route::get('/post/my-post', 'Api\PostController@myPost');
	Route::get('/post/{id}', 'Api\PostController@show');
	Route::post('/post/{id}/update', 'Api\PostController@update');
	Route::get('/post/{id}/delete', 'Api\PostController@destroy');
});