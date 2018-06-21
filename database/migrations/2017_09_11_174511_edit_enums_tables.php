<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditEnumsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('enums', function (Blueprint $table) {
            $table->unsignedInteger('parent_id')->nullable();
        });
        Schema::drop('enum_values');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('enums', function (Blueprint $table) {
            $table->removeColumn('parent_id');
        });
    }
}
