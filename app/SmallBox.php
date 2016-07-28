<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmallBox extends Model
{
    protected $fillable = [
        'concept', 'type', 'amount', 'enable',
    ];
}
