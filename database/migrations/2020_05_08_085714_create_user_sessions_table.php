<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_sessions', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('ip_address', 255)->nullable();
            $table->string('browser', 255)->nullable();
            $table->string('country', 255)->nullable();
            $table->string('country_code', 255)->nullable();
            $table->string('zip_code', 255)->nullable();
            $table->string('city', 255)->nullable();
            $table->integer('user_id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_sessions');
    }
}
