<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 27.11.2017
 * Time: 23:24
 */

namespace App\Jobs;


use App;
use App\Http\Controllers\Telegram\TelegramBotController;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Log;

class TelegramBotJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct()
    {

    }

    public function handle()
    {
        Log::info('bot_run');
        /** @var TelegramBotController $botController */
        $botController = App::make(TelegramBotController::class);
        $botController->processUpdates();
    }
}