<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $primaryKey = 'pid';
    protected $guarded = [];

    public function type(){
        return $this->belongsTo('App\ProductType', 'tid');
    }

    public function vendor(){
        return $this->belongsTo('App\Vendor','vid');
    }
}
