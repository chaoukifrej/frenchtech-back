<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Buffer;
use Faker\Generator as Faker;

$factory->define(Buffer::class, function (Faker $faker) {
    return [
        'logo' => $faker->imageUrl(640, 480, 'animals', true),
        'name' => $faker->company(),
        'type_of_demand' => $faker->randomElement(['register', 'update', 'delete']),
        'adress' => $faker->address(),
        'postal_code' => $faker->randomNumber(5, true),
        'city' => $faker->word(),
        'longitude' => $faker->longitude(43.7, 43.8),
        'latitude' => $faker->latitude(7.2, 7.3),
        'email' => $faker->unique()->safeEmail(),
        'phone' => $faker->phoneNumber(),
        'category' =>  $faker->randomElement(['startUp', 'association', 'organismeFinanceur', 'organismeDeFormation', 'servicePublic', 'tpePme', 'eti', 'poleDeCompetitivite']),
        'associations' => $faker->randomElement(['cannesIsUp', 'clubGrasse', 'NiceStartsUp', 'telecomValley']),
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
