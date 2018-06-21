<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Categories
 *
 * @mixin \Eloquent
 * @property int $id
 * @property int|null $parent_id
 * @property int|null $position
 * @property string|null $title
 * @property string $alias
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
class Categories extends Model
{
    protected $table = 'tbl_category_new';

    public function get_medcenters()
    {
      $medcenter_categories_array=[];
        $medcenter_categories = DB::table('medcenters_categories')->select('medcenter_id')->where('category_id', $this->id)->get();
      foreach ($medcenter_categories as $item) {
        $medcenter_categories_array[]=$item->medcenter_id;
      }

        return Medcenter::whereIn('id', $medcenter_categories_array)->get();
    }
}
