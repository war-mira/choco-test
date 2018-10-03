<?php

namespace App;

use App\Interfaces\IMetadataProvider;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Posts
 *
 * @mixin \Eloquent
 * @property int $id Id
 * @property int $category_id Id Категории
 * @property string $title Заголовок
 * @property string $type Тип поста
 * @property string $alias Алиас
 * @property string $content Контент
 * @property string $content_lite Краткое описание
 * @property string|null $meta_title
 * @property string $meta_key Ключевые слова
 * @property string $meta_desc Мета описание
 * @property int $date_create Дата создания
 * @property int $date_update Дата обновления
 * @property int $user_id Создатель поста
 * @property int $is_top
 * @property int $status Опубликован?
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post whereAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post whereContentLite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post whereDateCreate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post whereDateUpdate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post whereIsTop($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post whereMetaDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post whereMetaKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post whereMetaTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post whereUserId($value)
 * @property string|null $cover_image
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read mixed $date
 * @property-read mixed $status_name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post whereCoverImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post whereUpdatedAt($value)
 */
class Post extends Model
{
    use IMetadataProvider;
    const STATUS = [
        0 => 'Скрыт',
        1 => 'Опубликован',
        2 => 'Удален'
    ];

    protected $fillable = [
        'title',
        'type',
        'alias',
        'content',
        'content_lite',
        'meta_title',
        'meta_key',
        'meta_desc',
        'status',
        'date_create',
        'date_update',
        'is_top',
        'status',
        'cover_image'];
    protected $table = 'posts';
    public $timestamps = true;

    protected $appends = [
        'status_name'
    ];

    public function getContentLiteAttribute($value)
    {
        return strip_tags($value);
    }

    public function getDateAttribute()
    {
        return date("d.m.Y", $this->attributes['date_create']);
    }

    public function getStatusNameAttribute()
    {
        return self::STATUS[$this->status];
    }

    public function getMetaTitle()
    {
        return $this->meta_title;
    }

    public function getMetaDescription()
    {
        return $this->meta_desc;
    }

    public function getMetaKeywords()
    {
        return $this->meta_key;
    }
}
