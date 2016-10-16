<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detraction extends Model
{

    protected $fillable = ['voucher', 'detraction_date', 'value'];

    public function output()
    {
        return $this->belongsTo('App\Output');
    }
}
