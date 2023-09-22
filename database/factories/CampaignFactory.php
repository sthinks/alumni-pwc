<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Campaign;
use Faker\Generator as Faker;

$factory->define(Campaign::class, function (Faker $faker) {
    $poster = $faker->image(storage_path('app/public/uploads'), 800, 600, 'png', false);
    return [
        'campaign_title' => $faker->sentence(),
        'campaign_category' => \App\CampaignCategory::all()->random()->id,
        'campaign_abstract' => $faker->realText(),
        'campaign_text' => $faker->realText(),
        'campaign_poster' => $poster,
        'campaign_code' => $faker->word(),
        'campaign_end_date' => now()->addDay(),
        'campaign_seo_url' => $faker->slug(),
        'campaign_limit' => $faker->numberBetween(0, 10000),
        'campaign_visible' => true,
        'campaign_edit_by' => \App\User::all()->random()->id,
    ];
});

$factory->state(Campaign::class, 'past_event', [
    'campaign_end_date' => now()->subDay(),
]);

$factory->state(Campaign::class, 'not_active', [
    'campaign_visible' => false,
]);
