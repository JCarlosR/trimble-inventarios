<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Output extends Model
{

    protected $fillable = [
        'customer_id', 'type', 'reason', 'comment'
    ];

    public function details()
    {
        return $this->hasMany('App\OutputDetail');
    }

}
