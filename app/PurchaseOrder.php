<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    protected $fillable = [
        'invoice', 'invoice_date',
        'provider_id', 'user_id', 'igv', 'comment', 'state', 'total',
        'shipping', 'type_doc', 'currency', 'active'
    ];

    public function details()
    {
        return $this->hasMany('App\PurchaseOrderDetails');
    }

    public function provider()
    {
        return $this->belongsTo('App\Provider', 'provider_id');
    }
}
