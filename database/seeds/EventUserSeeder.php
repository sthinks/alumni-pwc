<?php

use Illuminate\Database\Seeder;

class EventUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Event::class, 3)->create();

        $users = factory(App\User::class, 3)->create();

        App\Event::all()->each(function ($event) use ($users) {
            $event->users()->saveMany($users);
        });
    }
}
