<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\CommentRate
 *
 * @property int $id
 * @property int $user_id
 * @property int $comment_id
 * @property int $rate
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Comment $comment
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CommentRate down()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CommentRate up()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CommentRate whereCommentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CommentRate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CommentRate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CommentRate whereRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CommentRate whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CommentRate whereUserId($value)
 * @mixin \Eloquent
 */
class CommentRate extends Model
{
    protected $table = 'comments_rate';
    protected $fillable = [
        'user_id',
        'comment_id',
        'rate'
    ];
    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function comment()
    {
        return $this->belongsTo(Comment::class, 'comment_id', 'id');
    }

    public function scopeUp(Builder $query)
    {
        return $query->where('rate', '>', 0);
    }

    public function scopeDown(Builder $query)
    {
        return $query->where('rate', '<', 0);
    }
}
