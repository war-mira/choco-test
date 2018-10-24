<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedcenterTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medcenter_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('alias');
            $table->string('h1')->nullable();
            $table->string('description')->nullable();
            $table->string('keywords')->nullable();
            $table->integer('active')->default(0);
            //$table->timestamps();
        });
        Schema::create('medcenter_type', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('medcenter_id');
            $table->integer('type_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medcenter_types');
        Schema::dropIfExists('medcenter_type');
    }
}
