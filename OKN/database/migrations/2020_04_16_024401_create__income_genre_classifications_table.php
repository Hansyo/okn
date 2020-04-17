<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncomeGenreClassificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('IncomeGenreClassifications', function (Blueprint $table) {
          $table->unsignedBigInteger('parent');
          $table->unsignedBigInteger('child');
          $table->foreign('parent')->references('id')->on('IncomeGenres')->onDelete('cascade');
          $table->foreign('child')->references('id')->on('IncomeGenres')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('IncomeGenreClassifications');
    }
}
