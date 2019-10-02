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

$factory->define(App\Person::class, function (Faker $faker) {
    return [
        'tenant_id' => 1,
        'salutation' => $faker->randomElement(['mr', 'mrs']),
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'title' => $faker->jobTitle,
        'company_name' => $faker->company,
        'phone' => $faker->phoneNumber,
        'mobile' => $faker->phoneNumber,
        'fax' => $faker->phoneNumber,
        'email' => $faker->unique()->safeEmail,
        'approved' => 1,
        'website' => $faker->domainName,
        'notes' => $faker->paragraph($nbSentences = 2, $variableNbSentences = true),
    ];
});
