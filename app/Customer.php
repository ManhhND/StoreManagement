<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $primaryKey = 'cid';
    protected $guarded = [];

    public function invoice(){
    	return $this->hasMany('App\Invoice','iid');
    }
}
