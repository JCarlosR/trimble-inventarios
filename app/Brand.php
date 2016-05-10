<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'brands';

    public $timestamps = false;

    protected $fillable = ['name','description'];


    public function product()
    {
        return $this->hasMany('App\Product', 'product_id');
    }
    public function exemplar()
    {
        return $this->hasMany('App\Exemplar', 'exemplar_id');
    }
}
