<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Payments', function (Blueprint $table) {
            //
            $table->id();
            $table->string('name');
            $table->string('memo');
            $table->foreignID('paymentGenre_id')->constrained()->nullable()->onDelete('set null');
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
