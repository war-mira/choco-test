<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CommentsMorphColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_comments', function (Blueprint $table) {
            $table->renameColumn('owner_name', 'owner_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tbl_comments', function (Blueprint $table) {
            $table->renameColumn('owner_type', 'owner_name');
        });
    }
}
