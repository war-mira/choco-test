<?php

namespace App\Model\Cabinet;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\Cabinet\ModelUpdate
 *
 * @property int $id
 * @property string $model_type
 * @property int|null $model_id
 * @property string|null $update_data
 * @property int $created_by
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Cabinet\ModelUpdate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Cabinet\ModelUpdate whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Cabinet\ModelUpdate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Cabinet\ModelUpdate whereModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Cabinet\ModelUpdate whereModelType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Cabinet\ModelUpdate whereUpdateData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Cabinet\ModelUpdate whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ModelUpdate extends Model
{
    protected $table = 'model_updates';
    public $timestamps = true;
    protected $fillable = [
        'model_type',
        'model_id',
        'update_data',
        'created_by'
    ];
}
