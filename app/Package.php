<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = [
        'name', 'code', 'description', 'state',
    ];

    public function details()
    {
        return $this->hasMany('App\Item');
    }

}
