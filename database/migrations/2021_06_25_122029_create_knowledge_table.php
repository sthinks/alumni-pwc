<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKnowledgeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('knowledge', function (Blueprint $table) {
            $table->id();
            $table->string('knowledge_title');
            $table->string('knowledge_seo_url');
            $table->text('knowledge_text');
            $table->string('knowledge_poster', 511);
            $table->string('knowledge_file', 511)->nullable();
            $table->unsignedBigInteger('knowledge_edit_by');
            $table->boolean('knowledge_visible')->default(true);
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
        Schema::dropIfExists('knowledge');
    }
}
