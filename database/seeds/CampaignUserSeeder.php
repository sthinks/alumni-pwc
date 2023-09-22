<?php

use App\Campaign;
use Illuminate\Database\Seeder;

class CampaignUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Campaign::flushEventListeners();
        factory(App\User::class, 3)->create();

        factory(App\Campaign::class, 100)->create();

        App\Campaign::All()->each(function ($campaign) {
            for ($i = 0; $i < mt_rand(5, 100); $i++) {
                $campaign->users()->attach(App\User::all()->random()->id);
            }
        });
    }
}
