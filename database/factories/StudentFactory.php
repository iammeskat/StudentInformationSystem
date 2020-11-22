<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Student;
use Faker\Generator as Faker;
use App\Models\Advisor;
use App\Models\User;

$factory->define(Student::class, function (Faker $faker) {

	$advisor_id = Advisor::get()->random()->id;
	$latestStudent = Student::max('user_id');
	if(!$latestStudent){
		$latestStudent=0;
	}
	return [

		'user_id' => uniqueUserID($latestStudent),
		'student_id' => $faker->unique()->numberBetween(1703210200000, 2003210299999),
		'name' => $faker->name,
		'department' => 'CSE', //$faker->randomElements(['CSE', 'EEE', 'LAW'])[0],
		'batch' => $faker->randomElements(['30', '31', '32', '33'])[0],
		'semester' => $faker->randomElements(['8th', '7th', '6th', '5th'])[0],
		'advisor_id' => $advisor_id,
        

	];
});

function uniqueUserID($latestStudent)
{
    $user_id = User::select('id')->where('user_type', 'student')->where('id', '>', $latestStudent)->first();
    return $user_id;

}
