<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OutputDetail extends Model
{

    protected $fillable = [
        'output_id', 'item_id', 'price'
    ];

    public function output()
    {
        return $this->belongsTo('App\Output');
    }

    public function item()
    {
        return $this->belongsTo('App\Item');
    }

    public function devolution()
    {
        return $this->hasOne('App\Devolution');
    }

}
