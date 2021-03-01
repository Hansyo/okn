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
            $table->unsignedBigInteger('incomeGenre')->nullable();
            $table->foreign('incomeGenre')->references('id')->on('IncomeGenres')->onDelete('set null');
            $table->unsignedBigInteger('user');
            $table->foreign('user')->references('id')->on('users')->onDelete('cascade');
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
