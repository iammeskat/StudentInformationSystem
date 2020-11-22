<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Models\PostFor;
use App\Models\Post;

$factory->define(PostFor::class, function (Faker $faker) {
    return [
        'post_id' => $faker->unique()->numberBetween(1, 10),
        'all' => $faker->randomElements([0, 1])[0],
        'student' => $faker->randomElements([0, 1])[0],
        'semester' => $faker->randomElements([0, 1])[0],
        'teacher' => $faker->randomElements([0, 1])[0],
        'cr' => $faker->randomElements([0, 1])[0],
        'batch' => $faker->randomElements([0, 1])[0],
    ];
});
