<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHobbiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hobbies', function (Blueprint $table) {
            $table->id();
            $table->string('hobby_title');
            $table->string('hobby_seo_url')->nullable();
            $table->string('hobby_poster', 511);
            $table->text('hobby_description');
            $table->string('hobby_responsible')->nullable();
            $table->string('hobby_responsible_avatar')->nullable();
            $table->string('hobby_responsible_role')->nullable();
            $table->unsignedBigInteger('hobby_edit_by')->nullable();
            $table->boolean('hobby_visible')->default(true);
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
        Schema::dropIfExists('hobbies');
    }
}
