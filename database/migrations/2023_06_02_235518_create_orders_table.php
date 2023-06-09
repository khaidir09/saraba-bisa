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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('customers_id')->unsigned();
            $table->bigInteger('users_id')->unsigned();
            $table->string('order_date');
            $table->string('total_products');
            $table->string('sub_total');
            $table->string('invoice_no')->unique();
            $table->string('total');
            $table->string('payment_method');
            $table->string('pay');
            $table->string('due');
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
        Schema::dropIfExists('orders');
    }
};
