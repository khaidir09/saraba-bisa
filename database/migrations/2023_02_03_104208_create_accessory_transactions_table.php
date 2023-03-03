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
        Schema::create('accessory_transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('users_id')->unsigned();
            $table->integer('customers_id')->unsigned();
            $table->integer('accessories_id')->unsigned();
            $table->string('nomor_transaksi')->unique();
            $table->string('quantity');
            $table->string('harga');
            $table->string('modal');
            $table->string('diskon')->nullable();
            $table->string('is_approve')->nullable();
            $table->string('cara_pembayaran');
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
        Schema::dropIfExists('accessory_transactions');
    }
};
