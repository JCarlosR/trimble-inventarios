<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{

    protected $table = 'subcategories';

    public $timestamps = false;

    protected $fillable = ['name','description','category_id','state'];

    public function product()
    {
        return $this->hasMany('App\Product', 'product_id');
    }

    public function category()
    {
        return $this->belongsTo('App\Category', 'category_id');
    }
}
