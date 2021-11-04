<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteColumnToPondsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ponds', function (Blueprint $table) {
            $table->dropColumn('fish_species_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ponds', function (Blueprint $table) {
            $table->unsignedInteger('fish_species_id');
            $table->foreign('fish_species_id')->references('id')->on('fish_specieses');
        });
    }
}
