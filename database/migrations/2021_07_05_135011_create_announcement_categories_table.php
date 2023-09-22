<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class CreateAnnouncementCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('announcement_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->timestamps();
        });
        $categories = [
            'PwC’den Haberler',
            'Ayrıcalıklar',
            'Kariyer Fırsatları',
            'Vefat Duyuruları',
            'Etkinlik Duyuruları',
        ];
        // populate the database
        foreach ($categories as $category) {
            DB::table('announcement_categories')->insert([
                'name' => $category,
                'slug' => Str::slug($category),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('announcement_categories');
    }
}
