<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropColumnToPondDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pond_details', function (Blueprint $table) {
            $table->dropColumn('feed_type');
            $table->dropColumn('seed_size');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pond_details', function (Blueprint $table) {
            $table->text('feed_type')->nullable();
            $table->text('seed_size')->nullable();
        });
    }
}
