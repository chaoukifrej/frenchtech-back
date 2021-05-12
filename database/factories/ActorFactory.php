<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Actor;
use Faker\Generator as Faker;

$factory->define(Actor::class, function (Faker $faker) {
    return [
        'logo' => $faker->imageUrl(640, 480, 'animals', true),
        'name' => $faker->name,
        'adress' => $faker->address,
        'postal_code' => $faker->randomNumber(5, true),
        'city' => $faker->word(),
        'longitude' => $faker->randomFloat(6, 43, 43),
        'latitude' => $faker->randomFloat(6, 7, 7),
        'email' => $faker->unique()->safeEmail,
        'phone' => $faker->phoneNumber,
        'category' => $faker->word(),
        'associations' => $faker->word(),
        'description' => $faker->paragraph(),
        'facebook' => $faker->word(),
        'linkedin' => $faker->word(),
        'twitter' => $faker->word(),
        'activity_area' => $faker->word(),
        'funds' => $faker->randomNumber(7, false),
        'employees_number' => $faker->randomNumber(3, false),
        'jobs_available_number' => $faker->randomNumber(2, false),
        'women_number' => $faker->randomNumber(2, false),
        'revenues' => $faker->randomNumber(7, false),
        'magic_link' => $faker->word(),
    ];
});
