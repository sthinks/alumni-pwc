<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOptionalFieldsToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('second_surname')->nullable();
            $table->string('facebook')->nullable();
            $table->string('avatar', 511)->nullable();
            $table->string('second_mail')->nullable();
            $table->timestamp('second_mail_verified_at')->nullable();
            $table->string('home_address', 1027)->nullable();
            $table->string('university', 255)->nullable();
            $table->foreignId('legacy')->nullable()->references('id')->on('legacies')->onDelete('set null');
            $table->datetime('pwc_quit_year')->nullable();
            $table->foreignId('pwc_worked_office')->nullable()->references('id')->on('pwc_offices')->onDelete('set null');
            $table->foreignId('pwc_worked_team_los')->nullable()->references('id')->on('pwc_los')->onDelete('set null');
            $table->foreignId('pwc_worked_team_sublos')->nullable()->references('id')->on('pwc_sublos')->onDelete('set null');
            $table->string('current_work_sector')->nullable();
            $table->string('current_work_company')->nullable();
            $table->string('current_work_role')->nullable();
            $table->string('skills', 1027)->nullable();
            $table->string('certificates', 1027)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            
        });
    }
}
