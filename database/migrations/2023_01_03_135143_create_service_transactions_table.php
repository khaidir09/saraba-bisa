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
        Schema::create('service_transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('users_id')->unsigned();
            $table->integer('customers_id')->unsigned();
            $table->string('nomor_servis');
            $table->string('jenis_barang');
            $table->string('merek');
            $table->string('model_seri');
            $table->string('imei')->nullable();
            $table->string('warna')->nullable();
            $table->string('estimasi_biaya')->nullable();
            $table->string('uang_muka')->nullable();
            $table->string('kapasitas')->nullable();
            $table->string('kerusakan');
            $table->string('garansi');
            $table->string('kelengkapan')->nullable();
            $table->string('biaya')->nullable();
            $table->string('estimasi_pengerjaan')->nullable();
            $table->string('status_servis')->default('Belum cek');
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
        Schema::dropIfExists('service_transactions');
    }
};
