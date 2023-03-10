<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcedureFormulas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('procedure_formulas', function (Blueprint $table) {
            $table->id();
            $table->integer('form_procedure_id');
            $table->foreign('form_procedure_id')->references('id')->on('form_procedures');
            $table->string('note');
            $table->float('min_range');
            $table->float('max_range');
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
        Schema::dropIfExists('procedure_formulas');
    }
}
