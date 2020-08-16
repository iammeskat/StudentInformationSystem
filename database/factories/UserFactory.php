<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Teacher;
use App\Models\Advisor;
use App\Models\User;
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

// $factory->define(User::class, function (Faker $faker) {
//     return [
//         'name' => $faker->name,
//         'email' => $faker->unique()->safeEmail,
//         'email_verified_at' => now(),
//         'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
//         'remember_token' => Str::random(10),
//     ];
// });

$factory->define(Teacher::class, function (Faker $faker) {
    return [
    	'teacher_id' => random_int(100, 999),
        'name' => $faker->name,
        'department' => "Computer Science & Engineering",
        'phone_number' => Str::random(10),
        'email' => $faker->unique()->safeEmail,
        'email_verified' => 1,
        'email_verified_at' => \Carbon\Carbon::now(),
        'email_verification_token' => '',
        'password' => bcrypt('111111'),
        'picture_path' => $faker->imageUrl(),
        'status' => 'active',
        'remember_token' => Str::random(10),
    ];
});

$factory->define(Advisor::class, function (Faker $faker) {
	return [
		'teacher_id' => $faker->unique()->numberBetween(1, 10),
		'batch' => random_int(27, 37),
		'status' => 1,
	];
});
$factory->define(User::class, function (Faker $faker) {
	return [
		'Student_id' => '1703210201349',
		'name' => $faker->name,
		'department' => $faker->name,
		'batch' => '32nd',
		'semester' => '6th',
		'advisor_id' => '1',
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
