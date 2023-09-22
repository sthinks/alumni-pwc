<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Gallery;
use Faker\Generator as Faker;

$factory->define(Gallery::class, function (Faker $faker) {
    $poster = explode('\\', $faker->image(storage_path('app/public/uploads')));
    return [
        'gallery_url' => end($poster),
        'gallery_added_by' => $faker->numberBetween(0, 100),
    ];
});
