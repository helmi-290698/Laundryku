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
            $table->id();
            $table->foreignId('item_id');
            $table->string('harga_reguler')->nullable();
            $table->string('harga_oneday')->nullable();
            $table->string('harga_express')->nullable();
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
