<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contact;
use App\Trip;
use App\Destination;
use App\Accomidation;
use App\Recommendation;
use App\Subscriber;
use App\Category;
use App\Cruise;
use App\Hotel;
use App\Post;
use App\Team;
use Alert;
use App\Data;
use DB;

class HomeController extends Controller {

    public function getIndex() {
        $sliders = DB::table('sliders')
            ->select('sliders.*')
            ->where('id','=', 1)
            ->get();

        $destCount = Destination::count();
        $accCount = Accomidation::count();
        $tripCount = Trip::count();
        $cruiseCount = Cruise::count();
        $hotelCount = Hotel::count();

        $destinations = Destination::all();
        $accomidations = Accomidation::all();
        $recommendations = Recommendation::all();
        $categories = Category::all();
        $blogs = Post::all();
        $trips = Trip::all();
        $contact = new Contact;
        $data = new Data;

        return view('site.pages.home',compact('sliders','destCount','accCount','tripCount','contact','data','trips','categories','destinations','cruiseCount','hotelCount','recommendations','blogs'));
    }

    public function getAbout() {
        
        $data = new Data;
        $team = Team::all();
        $contact = new Contact;

        return view('site.pages.about',compact('data','team','contact'));
    }

    public function getContact() {
        
        $data = new Data;
        $contact = new Contact;

        return view('site.pages.contact',compact('data','contact'));
    }

    public function getSubscribe() {
        
        $data = new Data;
        $contact = new Contact;

        return view('site.pages.subscribe',compact('data','contact'));
    }

    public function message(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $address = $request->input('address');
        $message = $request->input('message');
        $data = array('name'=>$name,'email'=>$email,'address'=>$address,'message'=>$message);

        DB::table('messages')->insert($data);
        return back();
    }

    public function subscribe(Request $request)
    {
        if ($request->ajax()){
            $subscribe = $request->input('subscribe');
            $data = array('email'=>$subscribe);
            $subscriber = Subscriber::create($data);
            Alert::success('You Subscribed Successfully', 'Done!');
            return response($subscriber);             
            
        }
    }

}
