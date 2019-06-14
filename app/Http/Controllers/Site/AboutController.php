<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contacts;
use App\Data;
use DB;

class AboutController extends Controller {

    public function getIndex() {

        $contact = new Contacts;
    	$data = new Data;

        $stories = DB::table('stories')
            ->select('stories.*')
            ->where('active','=', 1)
            ->get();

        $clients = DB::table('clients')
            ->select('clients.*')
            ->get();


        return view('site.pages.about',compact('contact','data','stories','clients'));
    }

}
