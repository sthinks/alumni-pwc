<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Slider;
use Faker\Generator as Faker;

$factory->define(Slider::class, function (Faker $faker) {
    $poster = explode('\\', $faker->image(storage_path('app/public/uploads')));

    return [
        'slider_title' => $faker->sentence,
        'slider_image' => end($poster),
        'slider_link' => $faker->url,
        'slider_visible' => $faker->boolean,
        'slider_order' => $faker->randomDigit,
        'slider_topic' => $faker->sentence,
        'slider_desc' => $faker->text,
    ];
});
