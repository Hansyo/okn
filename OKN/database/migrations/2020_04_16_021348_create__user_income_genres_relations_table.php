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
          $table->foreignID('user_id')->constrained()->onDelete('cascade');
          $table->foreignID('incomeGenre_id')->constrained()->onDelete('cascade');
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
