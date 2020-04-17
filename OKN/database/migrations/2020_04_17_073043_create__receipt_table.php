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
        Schema::table('Receipts', function (Blueprint $table) {
            //
            $table->id();
            $table->date('purchase');
            $table->integer('amount');
            $table->string('memo');
            $table->foreignID('genre_id')->constrained();
            $table->foreignID('store_id')->constrained()->nullable()->onDelete('set null');
            $table->foreignID('payment_id')->constrained()->nullable()->onDelete('set null');
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
