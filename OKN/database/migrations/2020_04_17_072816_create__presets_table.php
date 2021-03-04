<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePresetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Presets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('price');
            $table->unsignedBigInteger('genre')->nullable();
            $table->foreign('genre')->references('id')->on('Genres')->onDelete('set null');
            $table->unsignedBigInteger('store')->nullable();
            $table->foreign('store')->references('id')->on('Stores')->onDelete('set null');
            $table->unsignedBigInteger('payment')->nullable();
            $table->foreign('payment')->references('id')->on('Payments')->onDelete('set null');
            $table->string('memo')->nullable();
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
        Schema::dropIfExists('Presets');
    }
}
