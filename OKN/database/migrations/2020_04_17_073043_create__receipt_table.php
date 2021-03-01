<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceiptTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Receipts', function (Blueprint $table) {
            //
            $table->id();
            $table->date('purchase');
            $table->integer('amount');
            $table->string('memo')->nullable();
            $table->unsignedBigInteger('genre');
            $table->foreign('genre')->references('id')->on('Genres');
            $table->unsignedBigInteger('store')->nullable();
            $table->foreign('store')->references('id')->on('Stores')->onDelete('set null');
            $table->unsignedBigInteger('payment')->nullable();
            $table->foreign('payment')->references('id')->on('Payments')->onDelete('set null');
            $table->unsignedBigInteger('user');
            $table->foreign('user')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('creditHistory');
            $table->foreign('creditHistory')->references('id')->on('CreditHistories')->onDelete('cascade');
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
        Schema::table('Receipts', function (Blueprint $table) {
            //
            Schema::dropIfExists('Receipts');
        });
    }
}
