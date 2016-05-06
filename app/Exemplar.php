<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exemplar extends Model
{
    public function product()
    {
        return $this->hasMany('App\Product', 'product_id');
    }
}