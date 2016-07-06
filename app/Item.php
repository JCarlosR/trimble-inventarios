<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{

    protected $fillable = [
        'product_id', 'series', 'state', 'package_id', 'box_id',
    ];

    protected $appends = [
        'product_name', 'current_location'
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

    public function getProductNameAttribute()
    {
        return $this->product->name;
    }

    public function getCurrentLocationAttribute()
    {
        return $this->box->full_name;
    }

}

