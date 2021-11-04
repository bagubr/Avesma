<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormProcedureDetailInputs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_procedure_detail_inputs', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('form_procedure_detail_id');
            $table->foreign('form_procedure_detail_id')->references('id')->on('form_procedure_details');
            $table->unsignedInteger('form_procedure_detail_formula_id');
            $table->foreign('form_procedure_detail_formula_id')->references('id')->on('form_procedure_detail_formulas');
            $table->float('score');
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
        Schema::dropIfExists('form_procedure_detail_inputs');
    }
}
