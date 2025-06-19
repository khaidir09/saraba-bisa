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
        Schema::table('service_transactions', function (Blueprint $table) {
            $table->string('exp_garansi_j', 255)->nullable();
            $table->string('modal_j', 255)->nullable();
            $table->string('service_actions', 255)->nullable();
            $table->string('products', 255)->nullable();
            $table->string('biaya_j', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('service_transactions', function (Blueprint $table) {
            //
        });
    }
};
