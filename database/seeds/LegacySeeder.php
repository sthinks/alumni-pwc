<?php

use App\Legacy;
use Illuminate\Database\Seeder;

class LegacySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $legacies = ['Price Waterhouse', 'Coopers&Lybrand', 'Strategy&', 'GSG Hukuk', 'PwC'];
        foreach ($legacies as $legacy) {
            Legacy::create([
                'name' => $legacy,
            ]);
        }
    }
}
