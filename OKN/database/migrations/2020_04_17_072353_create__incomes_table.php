<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Incomes', function (Blueprint $table) {
            $table->id();
            $table->integer('price');
            $table->date('date');
            $table->unsignedBigInteger('incomeGenre_id')->nullable();
            $table->foreign('incomeGenre_id')->references('id')->on('IncomeGenres')->onDelete('set null');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('Users')->onDelete('cascade');
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
        Schema::dropIfExists('Incomes');
    }
}
