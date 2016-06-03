<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    protected $fillable = ['name','shelf_id'];

    public function shelf()
    {
        return $this->hasMany('App\Shelf', 'shelf_id');
    }
    public function box()
    {
        return $this->belongsTo('App\Box', 'box_id');
    }
}
