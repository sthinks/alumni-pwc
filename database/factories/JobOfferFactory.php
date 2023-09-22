<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\JobOffer;
use Faker\Generator as Faker;

$factory->define(JobOffer::class, function (Faker $faker) {
    return [
        'job_owner_id' => factory(\App\User::class)->create()->first()->id,
        'job_company' => $faker->company,
        'job_abstract' => $faker->text(100),
        'job_title' => $faker->sentence(10),
        'job_seo_url' => $faker->slug(),
        'job_position' => $faker->sentence(),
        'job_position_level' => $faker->sentence(),
        'job_location' => factory(\App\City::class)->create()->first()->id,
        'job_description' => $faker->text(1000),
        'job_experience' => $faker->numberBetween(0, 100),
        'job_valid_till' => now()->addDay(),
        'job_apply_link' => $faker->url,
        'job_visible' => true,
        'job_edit_by' => App\User::all()->random()->id,
    ];
});

$factory->state(JobOffer::class, 'job_offer_due', [
    'job_valid_till' => now()->subDay(),
]);

$factory->state(JobOffer::class, 'not_active', [
    'job_visible' => false,
]);
