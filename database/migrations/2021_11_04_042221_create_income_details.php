<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncomeDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('income_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('income_id');
            $table->foreign('income_id')->references('id')->on('incomes');
            $table->string('name');
            $table->float('weight');
            $table->integer('price');
            $table->integer('total_price');
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
        Schema::dropIfExists('income_details');
    }
}
