<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFishPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fish_prices', function (Blueprint $table) {
            $table->id();
            $table->integer('fish_species_id');
            $table->foreign('fish_species_id')->references('id')->on('fish_specieses');
            $table->integer('price');
            $table->string('reported_at');
            $table->integer('city_id');
            $table->integer('province_id');
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
        Schema::dropIfExists('fish_prices');
    }
}
