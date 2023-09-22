<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_offers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('job_owner_id')->nullable();
            $table->string('job_company')->nullable();
            $table->boolean('job_company_visible')->default(true);
            $table->string('job_title')->nullable();
            $table->string('job_poster', 511)->nullable();
            $table->string('job_seo_url')->nullable();
            $table->string('job_position')->nullable();
            $table->string('job_position_level')->nullable();
            $table->unsignedBigInteger('job_location')->nullable();
            $table->text('job_description')->nullable();
            $table->unsignedSmallInteger('job_experience')->nullable();
            $table->string('job_apply_link')->nullable();
            $table->boolean('job_visible')->default(true);
            $table->unsignedBigInteger('job_edit_by')->nullable();
            $table->timestamp('job_valid_till')->nullable();
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
        Schema::dropIfExists('job_offers');
    }
}
