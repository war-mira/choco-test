<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropSkillOldPositionCategoryColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_skill', function (Blueprint $table) {
            $table->dropColumn(['position', 'category']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tbl_skill', function (Blueprint $table) {
            $table->integer('position')->default(0);
            $table->integer('category')->default(0);
        });
    }
}
