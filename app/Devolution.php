<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Devolution extends Model
{

    public function output_detail()
    {
        return $this->belongsTo('App\OutputDetail');
    }

}
