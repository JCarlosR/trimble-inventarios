<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    protected $fillable = [
        'name', 'surname', 'address', 'phone', 'gender', 'customer_type_id',
    ];

    public function customer_type()
    {
        return $this->belongsTo('App\CustomerType');
    }
}
