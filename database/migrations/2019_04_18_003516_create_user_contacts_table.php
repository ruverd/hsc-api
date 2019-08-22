<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_contacts', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade');

            $table->string('street_personal');
            $table->string('number_personal');
            $table->string('neighborhood_personal');
            $table->string('city_personal');
            $table->string('state_personal');
            $table->string('additional_personal')->nullable();
            $table->string('zipcode_personal');
            $table->string('phone_personal');

            $table->string('street_business');
            $table->string('number_business');
            $table->string('neighborhood_business');
            $table->string('city_business');
            $table->string('state_business');
            $table->string('additional_business')->nullable();
            $table->string('zipcode_business');
            $table->string('phone_business');
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
        Schema::dropIfExists('user_contacts');
    }
}
