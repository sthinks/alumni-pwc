<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\City;
use App\JobShare;
use App\User;
use Faker\Generator as Faker;

$factory->define(JobShare::class, function (Faker $faker) {
    return [
        'user_id' => User::where('id', '!=', '1')->get()->random()->id,
        'company' => $faker->company,
        'position' => $faker->jobTitle,
        'level' => $faker->title,
        'location' => City::all()->random()->id,
        'experience' => $faker->numberBetween(0, 40),
        'detail' => $faker->text,
        'date' => $faker->date(),
        'valid_till' => $faker->date(),
        'link' => $faker->url,
    ];
});
