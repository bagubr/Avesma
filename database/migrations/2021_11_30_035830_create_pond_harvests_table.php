<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePondHarvestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pond_harvests', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('pond_detail_id');
            $table->float('weight');
            $table->string('image');
            $table->date('harvest_at');
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
        Schema::dropIfExists('pond_harvests');
    }
}
