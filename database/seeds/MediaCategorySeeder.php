<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MediaCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // populate the database
        $categories = ['Etkinlik Sayfası', 'Hatırlı Sohbetler'];
        foreach ($categories as $category) {
            DB::table('media_categories')->insert([
                'name' => $category,
                'slug' => Str::slug($category),
            ]);
        }
    }
}
