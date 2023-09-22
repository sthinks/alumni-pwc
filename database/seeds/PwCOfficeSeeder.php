<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PwCOfficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $offices = [
            'İstanbul',
            'Ankara',
            'İzmir',
            'Bursa',
        ];
        foreach ($offices as $office) {
            DB::table('pwc_offices')->insert([
                'name' => $office,
            ]);
        }
    }
}
