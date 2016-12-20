<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrderDetails extends Model
{
    protected $fillable = [
        'purchase_order_id', 'product_id', 'quantity', 'originalprice', 'igv', 'subtotal'
    ];

    public function purchase()
    {
        return $this->belongsTo('App\PurchaseOrder');
    }

    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
