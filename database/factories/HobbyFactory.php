<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Hobby;
use Faker\Generator as Faker;

$factory->define(Hobby::class, function (Faker $faker) {
    $poster = $faker->image(storage_path('app/public/uploads'), 800, 800, 'png', false);
    $avatar = $faker->image(storage_path('app/public/uploads'), 250, 250, 'png', false);
    $roles = ['expert', 'developer', 'ceo'];
    return [
        'hobby_title' => $faker->sentence,
        'hobby_abstract' => $faker->text(100),
        'hobby_seo_url' => $faker->slug,
        'hobby_description' => $faker->text,
        'hobby_poster' => $poster,
        'hobby_responsible' => $faker->name,
        'hobby_responsible_avatar' => $avatar,
        'hobby_responsible_role' => $roles[array_rand($roles)],
        'hobby_edit_by' => App\User::all()->random()->id,
    ];
});
