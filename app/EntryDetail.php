<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EntryDetail extends Model
{
    protected $fillable = [
        'entry_id', 'product_id', 'series', 'quantity', 'price'
    ];

    protected $appends = ['location', 'name'];

    public function entry()
    {
        return $this->belongsTo('App\Entry');
    }

    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public function getLocationAttribute()
    {
        $item = Item::where('series', $this->series)->first();
        if (! $item)
            return '-';

        $box = $item->box;
        if (! $box)
            return '-';

        return $box->code;
    }

    public function getNameAttribute()
    {
        // Name of the proper product
        return $this->product->name;
    }

}
