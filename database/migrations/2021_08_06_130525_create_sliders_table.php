<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            $table->string('slider_title')->nullable();
            $table->string('slider_image', 511);
            $table->string('slider_link', 511)->nullable();
            $table->boolean('slider_visible')->default(true);
            $table->unsignedTinyInteger('slider_order')->default(0);
            $table->unsignedBigInteger('slider_edit_by')->nullable();
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
        Schema::dropIfExists('sliders');
    }
}
