<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Output extends Model
{

    protected $fillable = [
        'customer_id', 'type', 'comment'
    ];

}
