<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public $fillable = [
        'first_name',
        'last_name',
        'email',
        'mindbody_id',
        'address_line_1',
        'address_line_2',
        'city',
        'state',
        'postal_code',
        'active',
        'mobile_phone',
        'home_phone',
        'photo_url',
        'account_balance'
    ];

    public function letters()
    {
        return $this->hasMany(Letter::class);
    }

    public function emails()
    {
        return $this->hasMany(Email::class);
    }
}
