<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 08.03.2018
 * Time: 2:36
 */

namespace App\Enums;


use Illuminate\Database\Eloquent\Model;

class CustomListValue extends Model
{
    protected $table = 'custom_list_values';
    protected $primaryKey = 'value_id';
    protected $fillable = [
        'id',
        'value',
        'name',
        'alias',
        'description',

        'list_id'
    ];


    public function list()
    {
        return $this->belongsTo(CustomList::class, '', 'id');
    }

    public static function tryGetList($model, $column)
    {
        $table = $model->getTable();

        $list = CustomList::query()
            ->with('values')
            ->where([
                ['table', '=', $table],
                ['column', '=', $column]
            ])->first();
    }
}