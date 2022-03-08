<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColoumPondDetailIdWithCycleIdToIncomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('incomes', function (Blueprint $table) {
            $table->unsignedBigInteger('cycle_id')->nullable();
            $table->dropColumn('pond_detail_id');
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
            $table->dropColumn('cycle_id');
            $table->unsignedBigInteger('pond_detail_id')->nullable();
        });
    }
}
