<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Contact;
use Faker\Generator as Faker;

$factory->define(Contact::class, function (Faker $faker) {
    return [
        'contact_title' => $faker->name(),
        'contact_message' => $faker->text(),
    ];
});
