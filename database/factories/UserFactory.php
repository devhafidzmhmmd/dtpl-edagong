<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'username' => $faker->unique()->safeEmail,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'phone' => '628' . $faker->numerify('##########'),
        'postal_code' => $faker->numerify('#####'),
        'address' => $faker->address,
        'city' => $faker->city,
        'province' => $faker->randomElement(['DKI', 'JABAR', 'JATENG', 'JATIM']),
        'is_verified' => true,
        'user_type' => 'buyer',
        'remember_token' => str_random(10),
    ];
});
