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
            $table->unsignedBigInteger('genre_id');
            $table->foreign('genre_id')->references('id')->on('Genres');
            $table->unsignedBigInteger('store_id')->nullable();
            $table->foreign('store_id')->references('id')->on('Stores')->onDelete('set null');
            $table->unsignedBigInteger('payment_id')->nullable();
            $table->foreign('payment_id')->references('id')->on('Payments')->onDelete('set null');
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
