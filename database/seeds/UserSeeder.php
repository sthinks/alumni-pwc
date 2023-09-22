<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = factory(App\User::class, 10)->create();

        \App\Permission::all()->each(function ($permission) use ($users) {
            $permission->users()->saveMany($users);
        });
    }
}
