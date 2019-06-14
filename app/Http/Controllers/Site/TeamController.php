<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contacts;
use App\Data;
use DB;

class TeamController extends Controller {

    public function getIndex() {

        $contact = new Contacts;
    	$data = new Data;

        $team = DB::table('team')
            ->select('team.*')
            ->where('active','=', 1)
            ->get();

        return view('site.pages.team',compact('contact','data','team'));
    }

}
