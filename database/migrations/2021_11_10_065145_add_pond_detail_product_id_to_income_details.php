<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPondDetailProductIdToIncomeDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('income_details', function (Blueprint $table) {
            $table->dropColumn('name');
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
        Schema::table('income_details', function (Blueprint $table) {
            $table->string('name')->nullable();
            $table->dropForeign(['pond_detail_product_id']);
            $table->dropColumn('pond_detail_product_id');
        });
    }
}
