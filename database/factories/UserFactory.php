<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Teacher;
use App\Models\Advisor;
use App\Models\User;
use App\Models\Test;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'user_type' => $faker->randomElement(['student', 'teacher', 'student']),
        'phone_number' => Str::random(10),
        'email' => $faker->unique()->safeEmail,
        'email_verified' => 1,
        'email_verified_at' => \Carbon\Carbon::now(),
        'email_verification_token' => '',
        'password' => bcrypt('123456'),
        'picture_path' => $faker->imageUrl(),
        'status' => 1,

    ];
});
