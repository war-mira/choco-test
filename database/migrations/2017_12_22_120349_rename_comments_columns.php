<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameCommentsColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_comments', function (Blueprint $table) {
            $table->renameColumn('comment_text', 'text');
            $table->renameColumn('create_time', 'created_at');
            $table->renameColumn('update_time', 'updated_at');
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
            $table->renameColumn('text', 'comment_text');
            $table->renameColumn('created_at', 'create_time');
            $table->renameColumn('updated_at', 'update_time');
        });
    }
}
