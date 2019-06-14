<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Contact extends Model
{
    protected $fillable = ['phone','orgNum','vat','location',
                           'image1','image2','image3','content',
                           'workingHours','facebook','google','youtube'];

    public function get($value)
    {
        $contact = DB::table('contacts')
            ->select($value)
            ->first();

    if($contact)
        return $contact->$value;
    return '';
    }
}
