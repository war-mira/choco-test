<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ServiceItem extends Model
{
    protected $table = 'service_items';

    protected $fillable = [
        'vendor_type',
        'vendor_id',
        'name',
        'description',
        'price',
        'unit',
        'status'
    ];

    public function vendor()
    {
        return $this->morphTo();
    }
}
