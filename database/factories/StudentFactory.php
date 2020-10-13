<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Student;
use Faker\Generator as Faker;

$factory->define(Student::class, function (Faker $faker) {
	return [
		#'user_id' =>$faker->unique()->numberBetween(1, 15),
		'user_id' => 1,
		'student_id' => '1703210201349',
		'name' => $faker->name,
		'department' => $faker->name,
		'batch' => '32nd',
		'semester' => '6th',
		'advisor_id' => '3',
        

	];
});
