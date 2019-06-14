<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Camp extends Model
{
    protected $fillable = ['name','rate','image','active','destination_id','accomidation_id'];
}
