<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    //
    protected $fillable = [
        'name', 'surname', 'address', 'phone', 'gender', 'provider_type_id',
    ];

    public function provider_type()
    {
        return $this->belongsTo('App\ProviderType');
    }
}
