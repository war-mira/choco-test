<?php

namespace App;

use App\Helpers\FormatHelper;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Comments
 *
 * @mixin \Eloquent
 * @property string                                                           $owner_type
 * @property int                                                              $owner_id
 * @property int                                                              $id
 * @property int                                                              $user_rate
 * @property int                                                              $recommended
 * @property int|null                                                         $parent_id
 * @property int|null                                                         $creator_id
 * @property string|null                                                      $user_name
 * @property string|null                                                      $user_last_name
 * @property string|null                                                      $user_email
 * @property int|null                                                         $user_ip
 * @property string|null                                                      $text
 * @property int|null                                                         $created_at
 * @property int|null                                                         $updated_at
 * @property int                                                              $status
 * @property int                                                              $type
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment whereCommentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment whereCommentText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment whereCreateTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment whereCreatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment whereOwnerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment whereOwnerName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment whereParentCommentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment whereUpdateTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment whereUserEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment whereUserName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment whereUserRate($value)
 * @property int|null                                                         $parent_comment_id
 * @property int|null                                                         $created_at_unix
 * @property int|null                                                         $updated_at_unix
 * @property int|null                                                         $author_id
 * @property-read \App\User|null                                              $author
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent               $owner
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\CommentRate[] $rates
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Comment[]     $replies
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment whereAuthorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment whereCreatedAtUnix($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment whereOwnerType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment whereUpdatedAtUnix($value)
 */
class Comment extends Model
{
    const STATUS = [
        0 => 'Модерация',
        1 => 'Допущенный',
        2 => 'Закрытый'
    ];

    const typeCommon = 0;
    const typeQR = 1;

    const notRecommended = 0;
    const recommended = 1;

    protected $table = 'comments';
    public $timestamps = true;
    protected $primaryKey = 'id';
    protected $fillable = [
        'owner_id',
        'owner_type',
        'author_id',
        'user_rate',
        'recommended',
        'user_id',
        'user_name',
        'user_last_name',
        'user_email',
        'user_ip',
        'text',
        'created_at',
        'updated_at'
    ];

    public function getUserNameAttribute($value)
    {
        if ($this->author()->exists())
            $userName = $this->author->name;
        else
            $userName = $value;
        return $userName;
    }

    public function getUserEmailAttribute($value)
    {
        if ($this->author()->exists())
            $userEmail = $this->author->phone;
        else
            $userEmail = $value;
        return $userEmail;
    }

    public function setUserEmailAttribute($email)
    {
        if (isset($email))
            $this->attributes['user_email'] = FormatHelper::phone($email);
        else
            $this->attributes['user_email'] = null;
    }


    public function author()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

    public function owner()
    {
        return $this->morphTo();
    }

    public function doctor($id)
    {
        return $this->where('owner_id', $id)->where('owner_type', 'Doctor')->where('status', 1)->get();
    }

    public function doctors($ids)
    {
        return $this->whereIn('owner_id', $ids)->where('owner_type', 'Doctor')->where('status', 1)->get();
    }

    public function doctor_count($id)
    {
        return $this->where('owner_id', $id)->where('owner_type', 'Doctor')->where('status', 1)->count();
    }

    public function getlast($limit=3)
    {
        return $this->where('owner_type', 'Doctor')->where('status', 1)->orderby('created_at', 'desc')->limit($limit)->get();
    }


    public function replies()
    {
        return $this->morphMany(Comment::class, 'owner');
    }

    public function rates()
    {
        return $this->hasMany(CommentRate::class, 'comment_id', 'id');
    }

    public function scopeLocalPublic($query)
    {
        return $query->where('status', 1);
    }
}
