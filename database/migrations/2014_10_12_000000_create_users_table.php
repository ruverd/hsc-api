<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');

            $table->integer('profile_id')->unsigned()->default(1);
            $table->foreign('profile_id')->references('id')->on('profiles')->onUpdate('cascade');

            $table->integer('user_status_id')->unsigned()->default(1);
            $table->foreign('user_status_id')->references('id')->on('user_status')->onUpdate('cascade');

            $table->string('name');
            $table->boolean('gender')->default(1);
            $table->boolean('married')->default(1); //filing status
            $table->date('dob')->nullable();
            $table->date('registered')->nullable();
            $table->date('validated')->nullable();
            $table->date('approved')->nullable();
            $table->text('comment')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
