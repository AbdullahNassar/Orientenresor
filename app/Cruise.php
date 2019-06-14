<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cruise extends Model
{
    protected $fillable = ['name','image','rate','destination_id','accomidation_id','active'];

    public function destination(){
    	return $this->belongsTo(Destination::class);
    }

    public function accomidation(){
    	return $this->belongsTo(Accomidation::class);
    }
}
