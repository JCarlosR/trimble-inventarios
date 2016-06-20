<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{

    protected $fillable = [
        'product_id', 'series', 'state', 'package_id', 'box_id',
    ];

    public function package()
    {
        return $this->belongsTo('App\Package');
    }

    public function box()
    {
        return $this->belongsTo('App\Box');
    }

    public function output_details()
    {
        return $this->hasMany('App\OutputDetail');
    }

    public function product()
    {
        return $this->belongsTo('App\Product');
    }

}

