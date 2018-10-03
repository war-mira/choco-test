<?php

namespace App\Model\Telegram;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\Telegram\BotUser
 *
 * @property int $id
 * @property string $chat_id
 * @property string $menu_id
 * @property array $metadata
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property int|null $city_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Telegram\BotUser whereChatId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Telegram\BotUser whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Telegram\BotUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Telegram\BotUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Telegram\BotUser whereMenuId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Telegram\BotUser whereMetadata($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Telegram\BotUser whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class BotUser extends Model
{
    protected $table = 'telegram_bot_users';
    public $timestamps = true;
    protected $fillable = [
        'chat_id',
        'menu_id',
        'metadata',
        'city_id'
    ];
    protected $casts = [
        'metadata' => 'json'
    ];
}
