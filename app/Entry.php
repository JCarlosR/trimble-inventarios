<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{

    protected $fillable = [
        'provider_id', 'destination', 'comment',
    ];

    public function details()
    {
        return $this->hasMany('App\EntryDetail');
    }

}
