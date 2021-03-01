<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Payments', function (Blueprint $table) {
            //
            $table->id();
            $table->string('name');
            $table->string('memo')->nullable();
            $table->unsignedBigInteger('paymentGenre')->nullable();
            $table->foreign('paymentGenre')
                  ->references('id')->on('PaymentGenres')
                  ->onDelete('set null');
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
        Schema::table('Payments', function (Blueprint $table) {
            //
            Schema::dropIfExists('Payments');
        });
    }
}
