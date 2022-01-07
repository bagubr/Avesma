<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumToFormProcedureFormulasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('procedure_formulas', function (Blueprint $table) {
            $table->renameColumn('procedure_id', 'form_procedure_id');
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('procedure_formulas', function (Blueprint $table) {
            $table->renameColumn('form_procedure_id', 'procedure_id');
        });
    }
}
