<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $fillable = ['name','trip_id','optionPrice'];

    public function order(){
    	return $this->belongsTo(Order::class);
    }

    public function trip(){
    	return $this->belongsTo(Trip::class);
    }
}
