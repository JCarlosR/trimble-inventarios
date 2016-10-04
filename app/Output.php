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
        'customer_id', 'type', 'reason', 'comment', 'destination',
        'fechaAlquiler', 'fechaRetorno' // just for rentals
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
}
