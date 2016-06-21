<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Devolution extends Model
{

    protected $fillable = ['output_detail_id', 'output_package_id'];

    public function output_detail()
    {
        return $this->belongsTo('App\OutputDetail');
    }

}
