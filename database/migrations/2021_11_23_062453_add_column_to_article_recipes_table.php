<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToArticleRecipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('article_recipes', function (Blueprint $table) {
            $table->string('embed_link')->nullable();
            $table->string('file')->nullable();
            $table->string('type')->default('VIDEO_EMBED');
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('article_recipes', function (Blueprint $table) {
            $table->dropColumn('file');
            $table->dropColumn('embed_link');
            $table->dropColumn('type');
        });
    }
}
