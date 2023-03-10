<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnTotalScoreToFormProcedureInputUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('form_procedure_input_users', function (Blueprint $table) {
            $table->string('total_score')->nullable();
            $table->string('result')->nullable();
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
            $table->dropColumn('total_score');
            $table->dropColumn('result');
        });
    }
}
