<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    //
    protected $fillable = [
        'name', 'document', 'address', 'phone', 'type', 'provider_type_id', 'enable',
    ];

    public function provider_type()
    {
        return $this->belongsTo('App\ProviderType');
    }
}
