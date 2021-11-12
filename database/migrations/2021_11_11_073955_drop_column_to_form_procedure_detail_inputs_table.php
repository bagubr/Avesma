<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropColumnToFormProcedureDetailInputsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('users', 'form_procedure_detail_inputs'))
        {
            Schema::table('form_procedure_detail_inputs', function (Blueprint $table)
            {
                $table->dropColumn('pond_detail_id');
            });
        }
        Schema::table('form_procedure_detail_inputs', function (Blueprint $table) {
            $table->unsignedBigInteger('form_procedure_input_user_id');
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('form_procedure_detail_inputs', function (Blueprint $table) {
            $table->unsignedBigInteger('pond_detail_id');
            $table->dropColumn('form_procedure_input_user_id');
        });
    }
}
