<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\MedicalServiceOffer
 *
 * @property int $id
 * @property int $provider_id
 * @property string $provider_type
 * @property int $service_id
 * @property int $price
 * @property int $discount
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $provider
 * @property-read \App\MedicalService $service
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MedicalServiceOffer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MedicalServiceOffer whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MedicalServiceOffer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MedicalServiceOffer wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MedicalServiceOffer whereProviderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MedicalServiceOffer whereProviderType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MedicalServiceOffer whereServiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MedicalServiceOffer whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class MedicalServiceOffer extends Model
{
    protected $table = 'medical_service_offers';
    protected $fillable = [
        'provider_id',
        'provider_type',
        'service_id',
        'price',
        'discount'
    ];

    public function provider(){
        return $this->morphTo();
    }

    public function service(){
        return $this->belongsTo(MedicalService::class,'service_id','id');
    }
}
