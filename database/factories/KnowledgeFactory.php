<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Knowledge;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Knowledge::class, function (Faker $faker) {
    $poster = explode('\\', $faker->image(storage_path('app/public/uploads')));
    $file = explode('\\', $faker->image(storage_path('app/public/uploads')));
    $title = $faker->sentence();
    return [
        'knowledge_title' => $title,
        'knowledge_abstract' => $faker->text(100),
        'knowledge_text' => $faker->text(),
        'knowledge_poster' => end($poster),
        'knowledge_file' => end($file),
        'knowledge_seo_url' => Str::slug($title),
        'knowledge_visible' => $faker->boolean(),
        'knowledge_featured' => $faker->boolean(),
        'knowledge_edit_by' => factory(User::class)->create()->first()->id,
    ];
});
