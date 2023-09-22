<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('event_title');
            $table->string('event_poster', 511);
            $table->text('event_description')->nullable();
            $table->unsignedBigInteger('event_city')->nullable();
            $table->string('event_venue')->nullable();
            $table->unsignedMediumInteger('event_capacity')->nullable();
            $table->boolean('event_is_private')->default(false);
            $table->boolean('event_is_visible')->default(true);
            $table->timestamp('event_start_date')->nullable();
            $table->timestamp('event_end_date')->nullable();
            $table->timestamp('event_last_apply_date')->nullable();
            $table->unsignedBigInteger('event_edit_by')->nullable();
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
        Schema::dropIfExists('events');
    }
}
