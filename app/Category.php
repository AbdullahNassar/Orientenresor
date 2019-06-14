<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name','content','image','view'];

    public function trip(){
    	return $this->hasMany(Trip::class);
    }
}
