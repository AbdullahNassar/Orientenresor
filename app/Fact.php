<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fact extends Model
{
    protected $fillable = ['capital','religion','population','language','currency','area','destination_id'];

    public function destination(){
    	return $this->belongsTo(Destination::class);
    }
}
