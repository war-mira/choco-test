<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSeoTextColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('skills', function (Blueprint $table) {
            $table->text('seo_text');
        });
        Schema::table('medcenters', function (Blueprint $table) {
            $table->text('seo_text');
        });
        Schema::table('doctors', function (Blueprint $table) {
            $table->text('seo_text');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('skills', function (Blueprint $table) {
            $table->dropColumn('seo_text');
        });
        Schema::table('medcenters', function (Blueprint $table) {
            $table->dropColumn('seo_text');
        });
        Schema::table('doctors', function (Blueprint $table) {
            $table->dropColumn('seo_text');
        });
    }
}
