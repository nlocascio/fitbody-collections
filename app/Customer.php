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

    protected $appends = [
        'letters_count',
        'emails_count',
    ];

    public function letters()
    {
        return $this->hasMany(Letter::class);
    }

    public function emails()
    {
        return $this->hasMany(Email::class);
    }

    public function lettersCountRelation()
    {
        return $this
            ->hasOne(Letter::class)
            ->selectRaw('customer_id, count(*) as count')
            ->groupBy('customer_id');
    }

    public function getLettersCountAttribute()
    {
        if ( ! $this->relationLoaded('lettersCountRelation')) {
            $this->load('lettersCountRelation');
        }

        $related = $this->getRelation('lettersCountRelation');

        return ($related) ? (int) $related->count : 0;
    }

    public function emailsCountRelation()
    {
        return $this
            ->hasOne(Email::class)
            ->selectRaw('customer_id, count(*) as count')
            ->groupBy('customer_id');
    }

    public function getEmailsCountAttribute()
    {
        if ( ! $this->relationLoaded('emailsCountRelation')) {
            $this->load('emailsCountRelation');
        }

        $related = $this->getRelation('emailsCountRelation');

        return ($related) ? (int) $related->count : 0;
    }

    public function getMobilePhoneAttribute($mobileNumber)
    {
        return preg_replace('~.*(\d{3})[^\d]{0,7}(\d{3})[^\d]{0,7}(\d{4}).*~', '($1) $2-$3', $mobileNumber);

    }
}
