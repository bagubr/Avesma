<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NullableSeedSizeFromPondDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasColumn('pond_details', 'seed_size')) {
            Schema::dropColumns('pond_details', 'seed_size');
        }
        Schema::table('pond_details', function (Blueprint $table) {
            $table->double('seed_size')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(Schema::hasColumn('pond_details', 'seed_size')) {
            Schema::dropColumn('pond_details', 'seed_size');
        }
        Schema::table('pond_details', function (Blueprint $table) {
            $table->double('seed_size');
        });
    }
}
