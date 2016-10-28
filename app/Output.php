<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin \Eloquent
 */

class Output extends Model
{

    protected $fillable = [
        'invoice', 'invoice_date',
        'customer_id', 'user_id', 'igv', 'type', 'reason', 'comment', 'destination', 'state', 'total',
        'fechaAlquiler', 'fechaRetorno', 'shipping', 'type_doc', 'city', 'currency', 'active' // just for rentals
    ];

    protected $appends = [
        'rental_days', 'rental_state'
    ];

    protected $dates = ['fechaAlquiler', 'fechaRetorno'];

    public function details()
    {
        return $this->hasMany('App\OutputDetail');
    }

    public function getRentalDaysAttribute()
    {
        $now = Carbon::now();
        if (! $this->fechaAlquiler)
            return '';

        return $this->fechaAlquiler->diff($now)->days;
    }

    public function getRentalStateAttribute()
    {
        if ($this->completed)
            return 'Finalizado';

        $now = Carbon::now();
        if ($now < $this->fechaRetorno)
            return 'En curso';

        return 'Fuera de tiempo';
    }

    public function items()
    {
        return $this->hasMany('App\OutputDetail');
    }

    public function packages()
    {
        return $this->hasMany('App\OutputPackage');
    }

    public function customers()
    {
        return $this->belongsTo('App\Customer', 'customer_id');
    }

    public function detraction()
    {
        return $this->hasOne('App\Detraction');
    }

    public function getTotalPriceAttribute()
    {
        $items = $this->items;
        $packages = $this->packages;
        $total = 0;
        foreach ($items as $item) {
            $total += $item->price;
        }
        foreach ($packages as $package) {
            $total += $package->price;
        }
        return $total;
    }
}
