<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    protected $fillable = [
        'content',
        'subject'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
