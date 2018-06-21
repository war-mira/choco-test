<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePageSeo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_seo', function (Blueprint $table) {
            $table->increments('id');
            $table->string('class');
            $table->string('action');
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->string('keywords')->nullable();
            $table->string('h1')->nullable();
            $table->text('seo_text')->nullable();
        });

        DB::table('page_seo')->insert(
            array(
                'class' => 'Medcenter',
                'action' => 'list',
                'title' => 'Клиники в городе :city_name',
                'description' => 'Медициские центры в городе :city_name',
            )
        );

        DB::table('page_seo')->insert(
            array(
                'class' => 'Doctor',
                'action' => 'list',
                'title' => 'Все врачи в городе: :city_name',
                'description' => 'Врачи в городе :city_name поиск и вызов врача',
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('page_seo');
    }
}
