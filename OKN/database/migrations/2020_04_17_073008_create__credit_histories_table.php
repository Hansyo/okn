<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreditHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('CreditHistories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('credit_id');
            $table->foreign('credit_id')->references('id')->on('Credits')->onDelete('cascade');
            $table->date('date');
            $table->integer('amount');
            $table->string('memo')->nullable();
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
        Schema::dropIfExists('CreditHistories');
    }
}
