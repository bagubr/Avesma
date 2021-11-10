<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPondDetailProductIdToIncomes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('incomes', function (Blueprint $table) {
            $table->integer('pond_detail_product_id')->nullable();
            $table->foreign('pond_detail_product_id')->references('id')->on('pond_detail_products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('incomes', function (Blueprint $table) {
            $table->dropForeign(['pond_detail_product_id']);
            $table->dropColumn('pond_detail_product_id');
        });
    }
}
