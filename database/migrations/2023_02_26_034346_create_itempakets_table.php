<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itempakets', function (Blueprint $table) {
            $table->id('id_itempaket');
            $table->string('id_item');
            $table->string('harga_reguler');
            $table->string('harga_oneday');
            $table->string('harga_express');
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
        Schema::dropIfExists('itempakets');
    }
};
