<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGenreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Genres', function (Blueprint $table) {
            //
            $table->id();
            $table->string('name');
            $table->string('memo')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('user');
            $table->foreign('user')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('parent')->nullable();
            $table->foreign('parent')->references('id')->on('Genres')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Genres', function (Blueprint $table) {
          Schema::dropIfExists('Genres');
        });
    }
}
