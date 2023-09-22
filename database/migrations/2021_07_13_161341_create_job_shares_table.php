<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobSharesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_shares', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('company')->nullable();
            $table->string('position')->nullable();
            $table->string('level')->nullable();
            $table->unsignedBigInteger('location')->nullable();
            $table->unsignedSmallInteger('experience')->nullable();
            $table->text('detail')->nullable();
            $table->timestamp('date')->nullable();
            $table->timestamp('valid_till')->nullable();
            $table->string('link', 511)->nullable();
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
        Schema::dropIfExists('job_shares');
    }
}
