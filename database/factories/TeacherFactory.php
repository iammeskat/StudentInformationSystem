<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Teacher;
use Faker\Generator as Faker;
use App\Models\User;

$factory->define(Teacher::class, function (Faker $faker) {
	$latestTeacher = Teacher::max('user_id');
	if(!$latestTeacher){
		$latestTeacher=0;
	}
    return [
    	'user_id' => uniqueUserID1($latestTeacher),
    	'teacher_id' => $faker->unique()->numberBetween(170321020, 20032102),
        'name' => $faker->name,
        'department' => "CSE",
        
        'remember_token' => Str::random(10),
    ];
});

function uniqueUserID1($latestTeacher){
    $user_id = User::select('id')->where('user_type', 'teacher')->where('id', '>', $latestTeacher)->first();
    return $user_id;

}