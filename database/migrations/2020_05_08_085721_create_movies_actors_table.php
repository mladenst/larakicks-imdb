<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Support\Enum\MoviesActorRoleTypes;

class CreateMoviesActorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies_actors', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('movie_id')->unsigned();
            $table->integer('actor_id')->unsigned();
            $table->string('role', 255);
            $table->enum('role_type', MoviesActorRoleTypes::all());
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movies_actors');
    }
}
