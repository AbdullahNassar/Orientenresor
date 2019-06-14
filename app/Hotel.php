<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $fillable = ['name','location','facilities','image','accomidation_id','destination_id','rate','active'];

    public function order(){
    	return $this->belongsTo(Order::class);
    }

    public function accomidation(){
    	return $this->belongsTo(Accomidation::class);
    }

    public function hotelImage(){
    	return $this->hasMany(HotelImage::class);
    }
}
