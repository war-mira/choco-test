<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Patient
 *
 * @property int $id
 * @property string $firstname
 * @property string|null $lastname
 * @property string|null $middlename
 * @property \Carbon\Carbon|null $birthday
 * @property int $city_id
 * @property string $gender
 * @property string $phone
 * @property string|null $phone2
 * @property string|null $email
 * @property int $_users_migration_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\City $city
 * @property-read mixed $name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Order[] $orders
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Patient whereBirthday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Patient whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Patient whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Patient whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Patient whereFirstname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Patient whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Patient whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Patient whereLastname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Patient whereMiddlename($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Patient wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Patient wherePhone2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Patient whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Patient whereUsersMigrationId($value)
 * @mixin \Eloquent
 */
class Patient extends Model
{
    protected $table = 'patients';
    protected $fillable = [
        'firstname',
        'lastname',
        'middlename',
        'birthday',
        'gender',
        'phone',
        'phone2',
        'city_id',
        'email'
    ];
    protected $appends = [
        'name'
    ];
    protected $dates = [
        'birthday'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class, 'm_patient_id', 'id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function getNameAttribute()
    {
        return implode(' ', [$this->lastname, $this->firstname, $this->middlename]);
    }
}
