<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recommendation extends Model
{
    protected $fillable = ['_head','content','image','active'];
}
