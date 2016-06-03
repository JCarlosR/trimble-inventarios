<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Local extends Model
{
    protected $fillable = ['name','comment','type'];

    public function shelves()
    {
        return $this->hasMany('App\Shelf');
    }
}