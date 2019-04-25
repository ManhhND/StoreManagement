<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    protected $primaryKey = 'tid';
    protected $guarded = [];

    public function product(){
        return $this->hasMany('App\Product');
    }
}
