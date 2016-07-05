<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = ['name', 'code', 'description', 'state','box_id'];

    public function details()
    {
        return $this->hasMany('App\Item');
    }

    public function box()
    {
        return $this->belongsTo('App\Box');
    }

    public function items()
    {
        return $this->hasMany('App\Item');
    }
}