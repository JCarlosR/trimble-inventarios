<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EntryDetail extends Model
{

    public function entry()
    {
        return $this->belongsTo('App\Entry');
    }

    public function product()
    {
        return $this->belongsTo('App\Product');
    }

}
