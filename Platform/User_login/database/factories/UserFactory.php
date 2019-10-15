<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\DB\Member;

$factory->define(Member::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $faker->password,
        'coins' => $faker->numberBetween($min = 0, $max = 9999),
        'last_login_time' => $faker->dateTimeThisYear,
        'status' => $faker->boolean(),
    ];
});
