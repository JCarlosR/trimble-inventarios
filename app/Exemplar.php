<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exemplar extends Model
{

    protected $table = 'exemplars';

    public $timestamps = false;

    protected $fillable = ['name','description','brand_id','state'];

    public function product()
    {
        return $this->hasMany('App\Product', 'product_id');
    }
    public function brand()
    {
        return $this->belongsTo('App\Brand', 'brand_id');
    }
}
