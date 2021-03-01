<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentGenresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('PaymentGenres', function (Blueprint $table) {
            //
            $table->id();
            $table->string('name');
            $table->string('memo')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('parent')->nullable();
            $table->foreign('parent')->references('id')->on('PaymentGenres')->onDelete('SET NULL');
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
        Schema::table('PaymentGenres', function (Blueprint $table) {
            //
          Schema::dropIfExists('PaymentGenres');
        });
    }
}
