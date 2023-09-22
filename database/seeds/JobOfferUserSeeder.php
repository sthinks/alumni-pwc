<?php

use Illuminate\Database\Seeder;

class JobOfferUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 3)->create();

        factory(App\JobOffer::class, 3)->create();

        App\JobOffer::All()->each(function ($jobOffer) {
            foreach (\App\User::all() as $_) {
                if (random_int(0, 1)) {
                    $jobOffer->users()->attach(App\User::all()->random()->id);
                }
            }
        });
    }
}
