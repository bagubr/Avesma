<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePondDetailProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pond_detail_products', function (Blueprint $table) {
            $table->id();
            $table->integer('pond_detail_id');
            $table->foreign('pond_detail_id')->references('id')->on('pond_details');
            $table->string('name')->nullable();
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
        Schema::dropIfExists('pond_detail_products');
    }
}
