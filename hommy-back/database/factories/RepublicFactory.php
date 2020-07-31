<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Republic;
use Faker\Generator as Faker;

$factory->define(Republic::class, function (Faker $faker) {
    return [
        'name' => $faker->companySuffix,
        'city' => $faker->cityPrefix,
        'district' => $faker->state,
        'address' => $faker->streetAddress,
        'description' => $faker->randomDigit,
        'user_id' => factory('App\User')->create()->id,
    ];
});
