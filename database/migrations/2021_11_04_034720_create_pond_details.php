<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePondDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pond_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('pond_id');
            $table->foreign('pond_id')->references('id')->on('ponds');
            $table->unsignedInteger('fish_species_id');
            $table->foreign('fish_species_id')->references('id')->on('fish_specieses');
            $table->integer('seed_count');
            $table->float('seed_size');
            $table->string('feed_type');
            // $table->unsignedInteger('feed_type_id');
            // $table->foreign('feed_type_id')->references('id')->on('feed_types');
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
        Schema::dropIfExists('pond_details');
    }
}
