<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFormProcedureIdToFormProcedureInputUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('form_procedure_input_users', function (Blueprint $table) {
            $table->integer('form_procedure_id')->nullable();
            $table->foreign('form_procedure_id')->references('id')->on('fish_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('form_procedure_input_users', function (Blueprint $table) {
            $table->dropForeign(['form_procedure_id']);
            $table->dropColumn('form_procedure_id');
        });
    }
}
