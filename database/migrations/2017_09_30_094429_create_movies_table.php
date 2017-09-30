<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->string('title', 40);
            $table->string('writer', 30);
            $table->string('director', 30);
            $table->integer('movie_length');
            $table->integer('movie_year');
            $table->text('description');
            $table->text('imdb_url');
            $table->decimal('imdb_rank', 3,1);
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
        Schema::dropIfExists('movies');
    }
}
