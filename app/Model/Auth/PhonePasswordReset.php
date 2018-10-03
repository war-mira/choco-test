<?php

namespace App\Model\Auth;

use App\User;
use Illuminate\Database\Eloquent\Model;

class PhonePasswordReset extends Model
{
    const STATUS_REQUESTED = 0;
    const STATUS_SENT = 1;
    const STATUS_ACTIVE = 2;
    const STATUS_EXPIRED = 3;
    const STATUS_FAILED = 4;

    protected $table = 'phone_password_resets';
    protected $fillable = [
        'user_id',
        'session_token',
        'reset_token',
        'phone',
        'code',
        'status',
        'expires_at'
    ];

    protected $dates = [
        'expiries_at'
    ];
    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
