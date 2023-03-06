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
        Schema::create('laundries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id');
            $table->foreignId('consument_id');
            $table->string('jenis_cucian');
            $table->double('jumlah');
            $table->double('total_biaya');
            $table->enum('status', ['antrian', 'cuci', 'setrika', 'packing', 'selesai'])->default('antrian');
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
        Schema::dropIfExists('laundries');
    }
};
