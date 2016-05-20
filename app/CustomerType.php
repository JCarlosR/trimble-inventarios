<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerType extends Model
{
    //
    protected $fillable = [
        'name', 'description',
    ];

    public function customers()
    {
        return $this->hasMany('App\Customer');
    }
}
