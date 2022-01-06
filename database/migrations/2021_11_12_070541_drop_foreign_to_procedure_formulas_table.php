<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropForeignToProcedureFormulasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('procedure_formulas', 'procedure_id'))
        {
            Schema::table('procedure_id', function (Blueprint $table)
            {
                $table->dropColumn('procedure_id');
                $table->dropForeign('procedure_formulas_procedure_id');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('procedure_formulas', function (Blueprint $table) {
            //
        });
    }
}
