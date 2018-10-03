<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelUpdatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('model_updates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('model_type');
            $table->unsignedInteger('model_id')->nullable();
            $table->text('update_data')->nullable();
            $table->unsignedInteger('created_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('model_updates');
    }
}
