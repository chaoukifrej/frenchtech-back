<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Historic;
use Faker\Generator as Faker;

$factory->define(Historic::class, function (Faker $faker) {
    return [
        'total_actors' => $faker->randomNumber(3),
        'total_funds' => $faker->randomFloat(2, 1, 99),
        'total_jobs_available' => $faker->randomNumber(3),
        'total_women_number' => $faker->randomNumber(3),
        'total_revenues' => $faker->randomFloat(2, 1, 99),
    ];
});
