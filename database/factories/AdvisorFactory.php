<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Advisor;
use App\Models\Teacher;
use Faker\Generator as Faker;

$factory->define(Advisor::class, function (Faker $faker) {
	$latestAdvisor = Advisor::max('teacher_id');
	if(!$latestAdvisor){
		$latestAdvisor=0;
	}
	return [
		'teacher_id' => uniqueUserID2($latestAdvisor),
		'batch' => random_int(27, 37),
		'status' => 1,
	];
});

function uniqueUserID2($latestAdvisor){
    $user_id = Teacher::select('id')->where('id', '>', $latestAdvisor)->first();
    return $user_id;

}