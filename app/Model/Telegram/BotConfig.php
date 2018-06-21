<?php

namespace App\Model\Telegram;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\Telegram\BotConfig
 *
 * @property int $param
 * @property string $value
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Telegram\BotConfig whereParam($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Telegram\BotConfig whereValue($value)
 * @mixin \Eloquent
 */
class BotConfig extends Model
{
    protected $table = 'telegram_bot_config';
    public $timestamps = false;
    protected $primaryKey = 'param';
    protected $fillable = [
        'param',
        'value'
    ];
}
