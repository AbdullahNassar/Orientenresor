<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Static extends Model
{
    protected $fillable = ['topTrips','categories','recommendations','blogs','homeFeaturesContent',
                           'homeFeatures','destnations','climate','optionsContent','aboutHead',
                           'aboutContent','aboutImage','teamContent','goal','mission','vision',
                           'benefits'];

    public function get($value)
    {
        $data = DB::table('statics')
            ->select($value)
            ->first();

    if($data)
        return $data->$value;
    return '';
    }
}
