<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Category
 *
 * @mixin \Eloquent
 * @property int $id
 * @property int|null $parent_id
 * @property int|null $position
 * @property string|null $title
 * @property string|null $alias
 * @property string|null $type
 * @property int|null $status
 * @property int|null $is_top
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereIsTop($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereType($value)
 */
class Category extends Model
{
    protected $table = 'tbl_category';

    
}
