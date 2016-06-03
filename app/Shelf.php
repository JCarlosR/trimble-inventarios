<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shelf extends Model
{
    protected $fillable = ['name','comment','local_id'];

    public function local()
    {
        return $this->belongsTo('App\Local');
    }

    public function levels()
    {
        return $this->hasMany('App\Level');
    }
}