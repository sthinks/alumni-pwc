<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('staff_id')->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->string('linkedin')->nullable();
            $table->string('phone_verify_code')->nullable();
            $table->string('password');
            $table->enum('user_type', ['alumni', 'admin', 'api', 'visitor'])->default('alumni');
            $table->unsignedTinyInteger('is_approved')->default(0);
            $table->timestamp('approved_at')->nullable();
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->unsignedTinyInteger('is_active')->default(1);
            $table->rememberToken();
            $table->datetime('birthdate')->nullable();
            $table->timestamp('phone_verified_at')->nullable();
            $table->timestamp('phone_verify_code_expires_at')->nullable();
            $table->datetime('pwc_join_year')->nullable();
            $table->timestamp('email_verified_at')->nullable();
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
        Schema::dropIfExists('users');
    }
}
