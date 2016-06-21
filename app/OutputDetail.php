<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OutputDetail extends Model
{

    protected $fillable = [
        'output_id', 'item_id', 'price'
    ];

    protected $appends = ['returned'];

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

    public function getReturnedAttribute()
    {
        if ($this->devolution == null)
            return false;
        return true;
    }
}
