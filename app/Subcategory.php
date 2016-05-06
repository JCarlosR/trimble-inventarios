<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    public function product()
    {
        return $this->hasMany('App\Product', 'product_id');
    }
}
