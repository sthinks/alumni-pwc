<?php

/** @var Factory $factory */

use App\Skill;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Skill::class, function (Faker $faker) {
    return [
        'name' => $faker->word()
    ];
});
