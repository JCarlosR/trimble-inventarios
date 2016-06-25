<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $table = 'categories';

    public $timestamps = false;

    protected $fillable = ['name','description','state'];


    public function product()
    {
        return $this->hasMany('App\Product', 'product_id');
    }
    public function subcategory()
    {
        return $this->hasMany('App\Subcategory', 'subcategory_id');
    }
}
