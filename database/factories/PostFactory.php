<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Models\Post;
use App\Models\User;

$factory->define(Post::class, function (Faker $faker) {

	$user_id = User::get()->random()->id;
    return [
        'user_id' => $user_id,
        'content' => $faker->realText(128),
        'status' => 1,
    ];
});
