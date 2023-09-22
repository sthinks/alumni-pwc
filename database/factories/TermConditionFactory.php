<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Enums\TermConditionType;
use App\TermCondition;
use Faker\Generator as Faker;

$factory->define(TermCondition::class, function (Faker $faker) {
    return [
        'type' => TermConditionType::getRandomValue(),
        'term' => $faker->text()
    ];
});
