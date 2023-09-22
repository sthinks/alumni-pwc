<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Announcement;
use App\AnnouncementCategory;
use App\User;
use Faker\Generator as Faker;

$factory->define(Announcement::class, function (Faker $faker) {
    $poster = $faker->image(storage_path('app/public/uploads'), 800, 600, 'png', false);
    return [
        'announcement_category_id' => AnnouncementCategory::all()->random()->id,
        'announcement_abstract' => $faker->text(100),
        'announcement_title' => $faker->sentence,
        'announcement_seo_url' => $faker->slug,
        'announcement_poster' => $poster,
        'announcement_text' => $faker->sentence,
        'announcement_edit_by' => factory(User::class)->create()->first()->id,
    ];
});
