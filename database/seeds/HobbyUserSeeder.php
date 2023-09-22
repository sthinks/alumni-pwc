<?php

use Illuminate\Database\Seeder;

class HobbyUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Hobby::class, 3)->create();

        App\Hobby::all()->each(function ($hobby) {
            $users = factory(App\User::class, mt_rand(10, 50))->create();
            $hobby->users()->saveMany($users);
        });
    }
}
