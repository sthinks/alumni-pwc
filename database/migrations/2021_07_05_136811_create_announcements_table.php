<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnnouncementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('announcement_category_id');
            $table->string('announcement_title');
            $table->string('announcement_seo_url');
            $table->string('announcement_poster', 511)->nullable();
            $table->text('announcement_text')->nullable();
            $table->string('announcement_link')->nullable();
            $table->boolean('announcement_is_visible')->default(true);
            $table->foreign('announcement_category_id')
                ->references('id')
                ->on('announcement_categories')
                ->cascadeOnDelete();
            $table->unsignedBigInteger('announcement_edit_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('announcements');
    }
}
