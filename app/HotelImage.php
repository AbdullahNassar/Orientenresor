<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HotelImage extends Model
{
    protected $fillable = ['image','hotel_id'];

    public function hotel(){
    	return $this->belongsTo(Hotel::class);
    }
}
