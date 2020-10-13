<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Teacher;
use Faker\Generator as Faker;


$factory->define(Teacher::class, function (Faker $faker) {
    return [
    	'user_id' =>$faker->unique()->numberBetween(1, 15),
    	'teacher_id' => random_int(100, 999),
        'name' => $faker->name,
        'department' => "Computer Science & Engineering",
        
        'remember_token' => Str::random(10),
    ];
});
