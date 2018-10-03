<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIllnessesGroupArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('illnesses_group_articles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('illnesses_group_id');
            $table->string('name');
            $table->string('alias');
            $table->text('description-lite');
            $table->text('description');
            $table->text('meta_title');
            $table->text('meta_key');
            $table->text('meta_desc');
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
        Schema::dropIfExists('illness_articles');
    }
}
