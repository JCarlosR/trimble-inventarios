<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{

    protected $fillable = [
        'provider_id', 'type', 'comment',
    ];

}
