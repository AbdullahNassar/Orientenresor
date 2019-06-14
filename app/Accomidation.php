<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accomidation extends Model
{
    protected $fillable = ['accname','rate'];

    public function order(){
    	return $this->belongsTo(Order::class);
    }

    public function hotel(){
    	return $this->hasMany(Hotel::class);
    }

    public function cruise(){
    	return $this->hasMany(Cruise::class);
    }
}
