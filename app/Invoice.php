<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $guarded = [];
    protected $primaryKey = 'iid';

    public function user(){
    	return $this->belongsTo('App\User','id');
    }
    public function customer(){
    	return $this->belongsTo('App\Customer','cid');
    }
}
