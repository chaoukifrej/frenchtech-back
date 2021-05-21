<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Buffer;
use Faker\Generator as Faker;

$factory->define(Buffer::class, function (Faker $faker) {
    return [
        'logo' => $faker->imageUrl(640, 480, 'animals', true),
        'name' => $faker->name,
        'type_of_demand' => $faker->randomElement(['register', 'update', 'delete']),
        'adress' => $faker->address,
        'postal_code' => $faker->randomNumber(5, true),
        'city' => $faker->word(),
        'longitude' => null,
        'latitude' => null,
        'email' => $faker->unique()->safeEmail,
        'phone' => $faker->phoneNumber,
        'category' => $faker->word(),
        'associations' => $faker->word(),
        'description' => $faker->paragraph(),
        'facebook' => $faker->word(),
        'linkedin' => $faker->word(),
        'twitter' => $faker->word(),
        'website' => $faker->word(),
        'activity_area' => $faker->word(),
        'funds' => $faker->randomFloat(2, 1, 99),
        'employees_number' => $faker->randomNumber(3, false),
        'jobs_available_number' => $faker->randomNumber(2, false),
        'women_number' => $faker->randomNumber(2, false),
        'revenues' => $faker->randomFloat(2, 1, 99),
        'magic_link' => $faker->word(),
    ];
});
