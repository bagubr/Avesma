<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFishCategoryIdToFishSpecieses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fish_specieses', function (Blueprint $table) {
            $table->integer('fish_category_id')->nullable();
            $table->foreign('fish_category_id')->references('id')->on('fish_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fish_specieses', function (Blueprint $table) {
            $table->dropForeign(['fish_category_id']);
            $table->dropColumn('fish_category_id');
        });
    }
}
