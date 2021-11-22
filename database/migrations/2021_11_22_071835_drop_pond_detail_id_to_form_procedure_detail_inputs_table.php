<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropPondDetailIdToFormProcedureDetailInputsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('form_procedure_detail_inputs', function (Blueprint $table) {
            $table->dropColumn('pond_detail_id');
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
        });
    }
}
