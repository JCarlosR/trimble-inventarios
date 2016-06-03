<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    protected $fillable = ['name','level_id'];

    public function level()
    {
        return $this->hasMany('App\Level', 'level_id');
    }
}
