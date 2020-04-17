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
            $table->foreignID('genre_id')->constrained()->nullable()->onDelete('set null');
            $table->foreignID('store_id')->constrained()->nullable()->onDelete('set null');
            $table->foreignID('payment_id')->constrained()->nullable()->onDelete('set null');
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
        Schema::dropIfExists('Presets');
    }
}
