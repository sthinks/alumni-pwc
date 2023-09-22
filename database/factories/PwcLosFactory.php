<?php

/** @var Factory $factory */

use App\PwcLos;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(PwcLos::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
    ];
});
