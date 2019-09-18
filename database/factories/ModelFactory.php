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

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    return [
    	'uuid' => $faker->uuid,
        'firstname' => $faker->firstName,
        'lastname' => $faker->lastName,
        'mobile_number' => $faker->e164PhoneNumber,
        'email' => $faker->email,
        'birthdate' => $faker->date,
        'gender' => $faker->randomElement(['Male', 'Female'])
    ];
});
