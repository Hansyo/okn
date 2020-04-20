<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserGenresRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('UserGenresRelations', function (Blueprint $table) {
          $table->unsignedBigInteger('user_id');
          $table->unsignedBigInteger('genre_id');
          $table->foreign('user_id')->references('id')->on('Users')->onDelete('cascade');
          $table->foreign('genre_id')->references('id')->on('Genres')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('UserGenresRelations');
    }
}
