<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    //
    public function provider_type()
    {
        return $this->belongsTo('App\ProviderType');
    }
}
