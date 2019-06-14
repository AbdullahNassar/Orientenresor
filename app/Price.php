<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $fillable = ['adults','children12','children2','singleRoom','doubleRoom','priceDate'];

}
