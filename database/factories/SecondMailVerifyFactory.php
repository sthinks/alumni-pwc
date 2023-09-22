<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\SecondMailVerify;
use Faker\Generator as Faker;

$factory->define(SecondMailVerify::class, function (Faker $faker) {
    return [
        'user_id' => factory(\App\User::class)->create()->id,
        'token' => $faker->word(),
    ];
});
