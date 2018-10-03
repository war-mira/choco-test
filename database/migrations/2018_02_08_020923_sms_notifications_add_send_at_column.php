<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SmsNotificationsAddSendAtColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sms_notifications', function (Blueprint $table) {
            $table->dateTime('send_at')->nullable();
            $table->integer('confirm_status')->default(0);
            $table->integer('send_status')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sms_notifications', function (Blueprint $table) {
            $table->dropColumn(['send_at']);
            $table->dropColumn(['confirm_status']);
            $table->dropColumn(['send_status']);
        });
    }
}
