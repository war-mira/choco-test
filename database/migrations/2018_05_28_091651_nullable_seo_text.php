<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NullableSeoText extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('skills', function (Blueprint $table) {
            $table->text('seo_text')->nullalble()->change();
        });
        Schema::table('medcenters', function (Blueprint $table) {
            $table->text('seo_text')->nullalble()->change();
        });
        Schema::table('doctors', function (Blueprint $table) {
            $table->text('seo_text')->nullalble()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
