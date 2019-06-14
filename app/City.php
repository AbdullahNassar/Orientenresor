<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = ['name','winter','spring','autumn','summer','destination_id'];

    public function destination(){
    	return $this->belongsTo(Destination::class,'destination_id');
    }
}
