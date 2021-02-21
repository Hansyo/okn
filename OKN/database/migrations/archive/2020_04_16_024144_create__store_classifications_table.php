<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoreClassificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('StoreClassifications', function (Blueprint $table) {
          $table->unsignedBigInteger('parent');
          $table->unsignedBigInteger('child');
          $table->foreign('parent')->references('id')->on('Stores')->onDelete('cascade');
          $table->foreign('child')->references('id')->on('Stores')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('StoreClassifications');
    }
}
