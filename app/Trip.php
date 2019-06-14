<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    protected $fillable = ['tripName','price','duration','_repeat','content','image','features','include','galleryContent','galleryVideo','destination_id','category_id','view','active'];

    public function program(){
    	return $this->hasMany(Program::class);
    }

    public function destination(){
    	return $this->belongsTo(Destination::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function option(){
    	return $this->hasMany(Option::class);
    }
}
