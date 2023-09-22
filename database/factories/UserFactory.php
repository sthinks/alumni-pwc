<?php

/** @var Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Str;

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

$factory->define(User::class, function (Faker $faker) {
    $avatar = explode('\\', $faker->image(storage_path('app/public/uploads'), 250, 250, 'avatar'));

    return [
        'staff_id' => null,
        'name' => $faker->name(),
        'email' => $faker->email,
        'phone' => $faker->phoneNumber,
        'linkedin' => $faker->url,
        'phone_verify_code' => $faker->swiftBicNumber,
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        'user_type' => 'alumni',
        'home_address' => $faker->address,
        'is_approved' => 1,
        'is_active' => 1,
        'birthdate' => $faker->dateTime(),
        'phone_verified_at' => $faker->dateTime(),
        'current_work_company' => $faker->company,
        'current_work_role' => $faker->jobTitle,
        'pwc_join_year' => $faker->dateTime(),
        'pwc_quit_year' => $faker->dateTime(),
        'avatar' => end($avatar),
        'uid' => Str::uuid(),
    ];
});

// admin state
$factory->state(App\User::class, 'admin', [
    'user_type' => 'admin',
]);

// not approved state
$factory->state(App\User::class, 'not_approved', [
    'is_apporved' => 0,
]);

// born today
$factory->state(App\User::class, 'born_today', [
    'birthdate' => now(),
]);

$factory->state(App\User::class, 'john_doe', [
    'name' => 'John Doe',
    'phone' => '9996408759',
]);
