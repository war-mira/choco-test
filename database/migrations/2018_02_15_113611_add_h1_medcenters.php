<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddH1Medcenters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('medcenters', function (Blueprint $table) {
            $table->string('meta_h1')->nullalble();
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
            $table->dropIfExists('meta_h1');
        });
    }
}
