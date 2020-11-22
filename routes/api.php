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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/register','Api\Users\AuthController@register');
Route::post('/login','Api\Users\AuthController@login');
Route::get('verify/{token}', 'Api\Students\AuthController@verifyEmail')->name('verify');

// Admin Panel
Route::group(['prefix'=>'admin'], function(){

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
	Route::post('/post/create', 'Api\Admins\PostController@createPost');

});
//user login
