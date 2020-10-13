<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Advisor;
use Faker\Generator as Faker;

$factory->define(Advisor::class, function (Faker $faker) {
	return [
		'teacher_id' => $faker->unique()->numberBetween(1, 15),
		'batch' => random_int(27, 37),
		'status' => 1,
	];
});

