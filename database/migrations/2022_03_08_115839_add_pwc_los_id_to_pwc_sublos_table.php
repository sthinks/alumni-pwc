<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPwcLosIdToPwcSublosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pwc_sublos', function (Blueprint $table) {
            $table->unsignedBigInteger('pwc_los_id')
                ->index()
                ->nullable()
                ->after('id');
            $table->foreign('pwc_los_id')
                ->references('id')
                ->on('pwc_los')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pwc_sublos', function (Blueprint $table) {
            $table->dropForeign(['pwc_los_id']);
            $table->dropColumn('pwc_los_id');
        });
    }
}
