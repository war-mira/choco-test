<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UsersChangeUnique extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('email', 150)->nullable()->change();
            $table->string('phone', 20)->change();
            $table->dropIndex('users_email_unique');
            $table->unique(['email', 'phone']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('email', 150)->change();
            $table->unique(['email']);
            $table->dropIndex('users_email_phone_unique');
        });
    }
}
