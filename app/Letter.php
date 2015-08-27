<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Letter extends Model
{
    public $fillable = [
        'file_path',
        'description',
        'amount'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
