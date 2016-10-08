<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    protected $fillable = [
        'invoice', 'payment', 'type', 'operation', 'enable', 'user_id', 'date'
    ];
}
