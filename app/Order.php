<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['adultsNum','children12','children2','singleRoomNum','doubleRoomNum','orderDate','fName','lName','gender','email','phone','DOB','accomidation_id','hotel_id','option_id','tript_id','destination_id'];

    public function option(){
    	return $this->hasMany(Option::class);
    }

    public function hotel(){
    	return $this->hasOne(Hotel::class);
    }

    public function accomidation(){
    	return $this->hasOne(Accomidation::class);
    }
}
