<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    protected $fillable = ['name','comment','shelf_id'];

    public function shelf()
    {
        return $this->belongsTo('App\Shelf');
    }

    public function boxes()
    {
        return $this->hasMany('App\Box');
    }
}
