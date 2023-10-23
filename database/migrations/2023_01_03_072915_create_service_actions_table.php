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
        Schema::create('service_actions', function (Blueprint $table) {
            $table->id();
            $table->string('nama_tindakan');
            $table->string('modal_sparepart');
            $table->string('harga_toko');
            $table->string('harga_pelanggan');
            $table->string('garansi');
            $table->softDeletes();
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
        Schema::dropIfExists('service_actions');
    }
};
