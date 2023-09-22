<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Media;
use Faker\Generator as Faker;

$factory->define(Media::class, function (Faker $faker) {
    $poster = explode('\\', $faker->image(storage_path('app/public/uploads')));
    return [
        'media_title' => $faker->sentence,
        'media_abstract' => $faker->text(100),
        'media_seo_url' => $faker->slug,
        'media_poster' => end($poster),
        'media_description' => $faker->text,
        'media_edit_by' => $faker->numberBetween(0, 100),
    ];
});
