<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EntryDetail extends Model
{
    protected $fillable = [
        'entry_id', 'product_id', 'series', 'quantity', 'price'
    ];

    public function entry()
    {
        return $this->belongsTo('App\Entry');
    }

    public function product()
    {
        return $this->belongsTo('App\Product');
    }

}
