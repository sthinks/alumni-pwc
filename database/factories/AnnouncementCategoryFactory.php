<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\AnnouncementCategory;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(AnnouncementCategory::class, function (Faker $faker) {
    $name = $faker->word();
    $slug = Str::slug($name);
    return [
        'name' => $name,
        'slug' => $slug,
    ];
});
