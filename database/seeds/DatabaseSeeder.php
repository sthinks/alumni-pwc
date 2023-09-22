<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CitySeeder::class,
            CompanySeeder::class,
            MediaCategorySeeder::class,
            PwCLosSeeder::class,
            PwCOfficeSeeder::class,
            PwCSubLosSeeder::class,
            PermissionSeeder::class,
            LegacySeeder::class,
        ]);
    }
}
