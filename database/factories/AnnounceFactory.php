<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use Faker\Generator as Faker;
use App\DB\Announce;

$factory->define(Announce::class, function (Faker $faker) {
    return [

        'title' => $faker->sentence($nbWords = 5, $variableNbWords = true),
        'content' => $faker->text($maxNbChars = 200),
        'releaseDate' => $faker->dateTimeThisYear,
        
    ];
});
