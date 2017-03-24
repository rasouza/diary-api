<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->name,
        'login' => $faker->userName,
        'email' => $faker->unique()->safeEmail,
        'bio' => $faker->text,
        'avatar' => $faker->imageUrl(460,460,'people','Faker'),
        'token' => $faker->md5,
        'refresh_token' => $faker->md5
    ];
});




