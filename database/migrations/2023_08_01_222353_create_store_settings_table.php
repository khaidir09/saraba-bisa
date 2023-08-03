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
        Schema::create('store_settings', function (Blueprint $table) {
            $table->id();
            $table->string('owner');
            $table->string('nama_toko');
            $table->string('deskripsi_toko')->nullable();
            $table->string('alamat_toko')->nullable();
            $table->string('nomor_hp_toko');
            $table->string('link_toko');
            $table->string('bank')->nullable();
            $table->string('rekening')->nullable();
            $table->string('pemilik_rekening')->nullable();
            $table->boolean('is_tax');
            $table->string('ppn')->nullable();
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
        Schema::dropIfExists('store_settings');
    }
};
