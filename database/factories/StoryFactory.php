<?php

$factory->define(App\Story::class, function(Faker\Generator $faker) {
    return [
        'title' => $faker->sentence,
        'description' => $faker->text,
        'link' => $faker->url,
        'project' => $faker->company
    ];
});

$factory->state(App\Story::class, 'custom date', function(Faker\Generator $faker) {
    return [
        'date' => $faker->date
    ];
});

$factory->state(App\Story::class, 'no project', function(Faker\Generator $faker) {
    return [
        'project' => null,
        'link' => null
    ];
});