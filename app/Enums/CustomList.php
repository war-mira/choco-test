<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 08.03.2018
 * Time: 2:36
 */

namespace App\Enums;


use Illuminate\Database\Eloquent\Model;

class CustomList extends Model
{
    protected $table = 'custom_lists';
    protected $fillable = [
        'value',
        'name',
        'alias',
        'description',

        'table',
        'column'
    ];

    public function values()
    {
        return $this->hasMany(CustomListValue::class, 'list_id', 'id');
    }

    public static function tryGetList($model, $column)
    {
        $table = $model::getModel()->getTable();

        $list = CustomList::query()
            ->where([
                ['table', '=', $table],
                ['column', '=', $column]
            ])->firstOrFail()->load('values');
        return $list;
    }
}