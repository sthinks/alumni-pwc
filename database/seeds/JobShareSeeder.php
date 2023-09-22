<?php

use Illuminate\Database\Seeder;

class JobShareSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\JobShare::class, 10)->create();
    }
}
