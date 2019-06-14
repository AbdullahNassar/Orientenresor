<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProgramImage extends Model
{
    protected $fillable = ['image','program_id'];

    public function program(){
    	return $this->belongsTo(Program::class);
    }
}
