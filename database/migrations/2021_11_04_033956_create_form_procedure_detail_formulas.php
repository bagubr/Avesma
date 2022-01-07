<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormProcedureDetailFormulas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_procedure_detail_formulas', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('form_procedure_detail_id');
            $table->foreign('form_procedure_detail_id')->references('id')->on('form_procedure_details');
            $table->string('parameter');
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
        Schema::dropIfExists('form_procedure_detail_formulas');
    }
}
