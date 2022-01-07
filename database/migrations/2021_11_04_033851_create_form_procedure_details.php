<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormProcedureDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_procedure_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('form_procedure_id');
            $table->foreign('form_procedure_id')->references('id')->on('form_procedures');
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
        Schema::dropIfExists('form_procedure_details');
    }
}
