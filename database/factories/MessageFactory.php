<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Message;
use App\User;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Message::class, function (Faker $faker) {
    return [
        'from' => factory(User::class)->create()->first()->id,
        'to' => factory(User::class, 2)->create()->last()->id,
        'message' => $faker->text,
        'sender_ip' => $faker->ipv4,
    ];
});

$factory->state(App\Message::class, 'html', [
    'message' => "<html lang='tr'><link href='https://www.pwc.com.tr'><p>Test</p></html>",
]);
