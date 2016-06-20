<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    protected $fillable = ['name','comment','level_id', 'full_name'];
    protected $appends   = ['code'];
    
    public function level()
    {
        return $this->belongsTo('App\Level');
    }

    public function items()
    {
        return $this->hasMany('App\Item');
    }

    public function getCodeAttribute()
    {
        return $this->level->shelf->local->name.'-'.$this->level->shelf->name.'-'.$this->level->name.'-'.$this->name;
    }
}
