<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProviderType extends Model
{
    //
    public function providers()
    {
        return $this->hasMany('App\Provider');
    }
}
