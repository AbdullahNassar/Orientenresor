<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $fillable = ['name','content','destination','visit','transportation','distance','cuisines','residence','tript_id','view','active'];

    public function programImage(){
    	return $this->hasMany(ProgramImage::class);
    }

    public function trip(){
    	return $this->belongsTo(Trip::class);
    }
}
