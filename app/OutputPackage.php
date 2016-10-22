<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OutputPackage extends Model
{
    protected $fillable = [
        'output_id', 'package_id', 'price', 'originalprice'
    ];

    protected $appends = ['returned'];

    public function package()
    {
        return $this->belongsTo('App\Package');
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
