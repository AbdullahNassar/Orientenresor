<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['_head','content','image','view','created_at','updated_at'];
}
