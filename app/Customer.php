<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    protected $fillable = [
        'name', 'document', 'address', 'phone', 'type', 'customer_type_id', 'enable',
    ];

    public function customer_type()
    {
        return $this->belongsTo('App\CustomerType');
    }
}
