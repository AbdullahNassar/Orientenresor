<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contact;
use App\Trip;
use App\Destination;
use App\Category;
use App\Data;
use DB;

use App\Reservation;

class TripsController extends Controller {

    public function getIndex() {

        $contact = new Contact;
        $data = new Data;
        $trips = Trip::all();
        $destCount = Destination::count();
        $categories = Category::all();
        $destinations = Destination::all();

        return view('site.pages.trips', compact('contact','data','trips','categories','destCount','destinations'));
    }

    public function getTrip($id) {

        if (isset($id)) {

        $contact = new Contact;
        $data = new Data;

        $trip = Trip::find($id)->get();
        $trips = Trip::all();

        $destination = DB::table('trips')
            ->select('destination_id')
            ->where('id','=', $id)
            ->get();

        $destinations = DB::table('destinations')
            ->join('accomidations', 'destinations.accomidation_id', '=', 'destinations.id')
            ->join('facts', 'destinations.fact_id', '=', 'destinations.id')
            ->select('destination_id')
            ->where('id','=', $id)
            ->get();


        return view('site.pages.service', compact('contact','data','trips','trip'));
        }
    }
}
