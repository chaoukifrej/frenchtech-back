<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Historic;
use Faker\Generator as Faker;

$factory->define(Historic::class, function (Faker $faker) {
    return [
        'total_actors' => 48,
        'total_funds' => 4444,
        'total_jobs_available' => 78,
        'total_women_number' => 65,
        'total_revenues' => 5,
    ];
});
