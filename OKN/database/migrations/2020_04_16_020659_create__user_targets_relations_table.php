<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTargetsRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('UserTargetsRelations', function (Blueprint $table) {
          $table->unsignedBigInteger('user_id');
          $table->unsignedBigInteger('target_id');
          $table->foreign('user_id')->references('id')->on('Users')->onDelete('cascade');
          $table->foreign('target_id')->references('id')->on('Targets')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('UserTargetsRelations');
    }
}
