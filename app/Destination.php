<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    protected $fillable = ['destName','content','image','galleryContent','galleryVideo','visaContent','vaccineContent','continent_id','view','active'];

    public function trip(){
    	return $this->hasMany(Trip::class);
    }

    public function continent(){
    	return $this->belongsTo(Continent::class);
    }

    public function fact(){
    	return $this->hasOne(Fact::class);
    }

    public function city(){
    	return $this->hasMany(City::class);
    }

    public function cruise(){
    	return $this->hasMany(Cruise::class);
    }
}
