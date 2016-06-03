<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shelf extends Model
{
    protected $fillable = ['name','local_id'];

    public function local()
    {
        return $this->hasMany('App\Local', 'local_id');
    }

    public function level()
    {
        return $this->belongsTo('App\Level', 'level_id');
    }
}