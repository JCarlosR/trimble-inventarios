<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name','description','price','money','part_number','brand_id','exemplar_id','color','category_id','subcategory_id','image','comment','state'];

    public function category()
    {
        return $this->belongsTo('App\Category', 'category_id');
    }
    public function subcategory()
    {
        return $this->belongsTo('App\Subcategory', 'subcategory_id');
    }
    public function brand()
    {
        return $this->belongsTo('App\Brand', 'brand_id');
    }
    public function exemplar()
    {
        return $this->belongsTo('App\Exemplar', 'exemplar_id');
    }

}
