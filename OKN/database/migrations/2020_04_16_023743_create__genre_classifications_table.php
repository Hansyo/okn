<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGenreClassificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('GenreClassifications', function (Blueprint $table) {
          $table->unsignedBigInteger('parent');
          $table->unsignedBigInteger('child');
          $table->foreign('parent')->references('id')->on('Users')->onDelete('cascade');
          $table->foreign('child')->references('id')->on('Users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('GenreClassifications');
    }
}
