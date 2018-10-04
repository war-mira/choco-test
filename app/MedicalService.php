<?php

namespace App;

use App\Enums\MedicalServiceType;
use Illuminate\Database\Eloquent\Model;

/**
 * App\MedicalService
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $default_price
 * @property int|null $parent_id
 * @property int $type
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read mixed $type_name
 * @property-read \App\MedicalService|null $parent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MedicalService whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MedicalService whereDefaultPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MedicalService whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MedicalService whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MedicalService whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MedicalService whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MedicalService whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MedicalService whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class MedicalService extends Model
{
    protected $table = 'medical_services';
    protected $fillable = [
        'name',
        'description',
        'default_price',
        'parent_id',
        'type'
    ];

    public function parent()
    {
        return $this->belongsTo(MedicalService::class, 'parent_id', 'id');
    }

    public function children()
    {
        return $this->hasMany(MedicalService::class, 'parent_id', 'id');
    }

    public function offers()
    {
        return $this->hasMany(MedicalServiceOffer::class, 'service_id', 'id');
    }

    public function getTypeNameAttribute(){
        return MedicalServiceType::getDescription($this->type);
    }
}
