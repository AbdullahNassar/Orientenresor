<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Continent extends Model
{
    protected $fillable = ['name','type','active'];

    public function destination(){
    	return $this->hasMany(Destination::class);
    }
}
