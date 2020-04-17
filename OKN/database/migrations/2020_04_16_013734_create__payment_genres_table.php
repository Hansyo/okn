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
        Schema::table('PaymentGenres', function (Blueprint $table) {
            //
            $table->id();
            $table->string('name');
            $table->string('memo');
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
