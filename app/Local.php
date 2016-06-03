<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Local extends Model
{
    protected $fillable = ['name'];

    public function shelf()
    {
        return $this->belongsTo('App\Shelf', 'shelf_id');
    }
}
