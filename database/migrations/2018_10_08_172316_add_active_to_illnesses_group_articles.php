<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddActiveToIllnessesGroupArticles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('illnesses_group_articles', function (Blueprint $table) {
            $table->integer('active')->default(0);
            $table->index('active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('illnesses_group_articles',function (Blueprint $table) {
            $table->dropColumn('active');
            $table->dropIndex('active');
        });
    }
}
