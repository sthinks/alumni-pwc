<?php

use App\Knowledge;
use Illuminate\Database\Seeder;

class KnowledgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Knowledge::flushEventListeners();
        factory(Knowledge::class, 100)->create();
    }
}
