<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Event;
use Faker\Generator as Faker;

$factory->define(Event::class, function (Faker $faker) {
    $poster = $faker->image(storage_path('app/public/uploads'), 800, 600, 'png', false);
    return [
        'event_title' => $faker->sentence(),
        'event_abstract' => $faker->text(100),
        'event_poster' => $poster,
        'event_description' => $faker->text(),
        'event_city' => random_int(0, 81),
        'event_venue' => $faker->address,
        'event_capacity' => random_int(0, 100),
        'event_start_date' => now()->addMonth(),
        'event_end_date' => now()->addMonths(2),
        'event_last_apply_date' => now()->addDays(mt_rand(0, 30)),
        'event_edit_by' => App\User::all()->random()->id,
    ];
});
