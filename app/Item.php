<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    //
    protected $fillable = [
        'product_id', 'series', 'state', 'package_id',
    ];
}