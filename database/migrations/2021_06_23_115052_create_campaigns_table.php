<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('campaign_title', 255);
            $table->unsignedBigInteger('campaign_category')->nullable();
            $table->string('campaign_company')->nullable();
            $table->text('campaign_text');
            $table->string('campaign_poster', 511);
            $table->string('campaign_code', 255);
            $table->string('campaign_seo_url', 255)->nullable();
            $table->unsignedMediumInteger('campaign_limit')->nullable();
            $table->timestamp('campaign_end_date')->nullable();
            $table->boolean('campaign_visible')->default(true);
            $table->unsignedBigInteger('campaign_edit_by');
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
        Schema::dropIfExists('campaigns');
    }
}
