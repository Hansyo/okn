<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserIncomeGenresRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('UserIncomeGenresRelations', function (Blueprint $table) {
          $table->unsignedBigInteger('user_id');
          $table->unsignedBigInteger('incomeGenre_id');
          $table->foreign('user_id')->references('id')->on('Users')->onDelete('cascade');
          $table->foreign('incomeGenre_id')->references('id')->on('IncomeGenres')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('UserIncomeGenresRelations');
    }
}
