<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameSkillsSeoColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('skills', function (Blueprint $table) {
            $table->renameColumn('seo_title', 'meta_title');
            $table->renameColumn('seo_keywords', 'meta_key');
            $table->renameColumn('seo_description', 'meta_desc');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->renameColumn('meta_title', 'seo_title');
            $table->renameColumn('meta_key', 'seo_keywords');
            $table->renameColumn('meta_desc', 'seo_description');
        });
    }
}
