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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'username' => $faker->userName,
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Letter::class, function (Faker\Generator $faker) {
    return [
        'file_path' => '/var/null',
        'description' => $faker->name,
        'amount' => $faker->numberBetween(50, 500)
    ];
});

$factory->define(App\Email::class, function (Faker\Generator $faker) {
    return [
        'content' => $faker->paragraphs(3),
        'subject' => $faker->sentence(6)
    ];
});