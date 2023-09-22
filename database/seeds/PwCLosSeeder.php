<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PwCLosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $los = ['Vergi', 'Denetim', 'Danışmanlık', 'Accelaration Centre', 'IFS', 'Hukuk'];
        foreach ($los as $lo) {
            DB::table('pwc_los')->insert(
                ['name' => $lo]
            );
        }
    }
}
