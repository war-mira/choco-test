<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMedcentersLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('medcenters', function (Blueprint $table) {
            $table->integer('like')->nullable();
            $table->integer('dislike')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('medcenters', function (Blueprint $table) {
            $table->integer('like')->nullable();
            $table->integer('dislike')->nullable();
        });
    }
}
