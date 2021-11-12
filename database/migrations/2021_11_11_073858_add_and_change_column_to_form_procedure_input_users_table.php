<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAndChangeColumnToFormProcedureInputUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('form_procedure_input_users', function (Blueprint $table) {
            $table->dropColumn('form_procedure_detail_input_id');
            $table->unsignedBigInteger('pond_detail_id');
            $table->date('reported_at');
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
            $table->dropColumn('pond_detail_id');
            $table->unsignedBigInteger('form_procedure_detail_input_id');
        });
    }
}
