<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\language;
use DB;

class Data extends Model
{
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
