<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    protected $fillable = ['name','comment','level_id'];

    public function level()
    {
        return $this->belongsTo('App\Level');
    }

    public function getCodeAttribute()
    {
        return $this->level->shelf->local->name.'-'.$this->level->shelf->name.'-'.$this->level->name.'-'.$this->name;
    }
}
