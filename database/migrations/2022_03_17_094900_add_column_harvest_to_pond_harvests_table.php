<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnHarvestToPondHarvestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pond_harvests', function (Blueprint $table) {
            $table->unsignedBigInteger('fish_per_kilogram')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pond_harvests', function (Blueprint $table) {
            $table->dropColumn('fish_per_kilogram');
        });
    }
}
