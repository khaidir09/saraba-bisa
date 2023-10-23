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
            $table->renameColumn('jenis_barang', 'types_id');
            $table->renameColumn('merek', 'brands_id');
            $table->renameColumn('model_seri', 'model_series_id');
            $table->string('garansi')->nullable()->change();
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
