<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OutputPackage extends Model
{
    protected $fillable = [
        'output_id', 'package_id', 'price'
    ];

}
