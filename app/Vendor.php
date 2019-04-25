<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $primaryKey = 'vid';
    protected $guarded = [];

    public function product(){
        return $this->hasMany('App\Product');
    }
}
