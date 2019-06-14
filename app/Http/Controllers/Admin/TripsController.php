<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Trip;
use App\Destination;
use App\Category;
use DB;
use Alert;

class TripsController extends Controller
{
    public function getIndex() {
    	$trips = Trip::all();
        return view('admin.pages.trip.index', compact('trips'));
    }

    public function getAdd() {
        $destinations = Destination::all();
        $categories = Category::all();
        return view('admin.pages.trip.add', compact('destinations','categories'));
    }

    public function insert(Request $request) {
    	$name = $request->input('name');
        $price = $request->input('price');
        $duration = $request->input('duration');
        $_repeat = $request->input('_repeat');
    	$image = $request->input('image');
        $content = $request->input('content');

        for ($i=1; $i <= 5 ; $i++) { 
            $features['feature'.$i] = $request->input('feature'.$i);
        }
        $feature = json_encode($features);

        for ($j=1; $j <= 5 ; $j++) { 
            $includes['include'.$j] = $request->input('include'.$j);
        }
        $include = json_encode($includes);

        $galleryContent = $request->input('galleryContent');
        $galleryVideo = $request->input('galleryVideo');
        $destination_id = $request->input('destination_id');
        $category_id = $request->input('category_id');
        $view = $request->input('view');
        $active = $request->input('active');
    	$data = array('tripName' => $name,'price' => $price,'duration' => $duration,'_repeat' => $_repeat, 'content' => $content , 'image' => $image ,
         'features' => $feature ,'include' => $include,'galleryContent' => $galleryContent ,
         'galleryVideo' => $galleryVideo ,'destination_id' => $destination_id,
         'category_id' => $category_id ,'view' => $view,'active' => $active);
    	$T = Trip::create($data);
        if ($T){
            Alert::success(' The Data Inserted successfully', 'Done!');
            $trips = Trip::all();
            return view('admin.pages.trip.index', compact('trips'));
        }else{
            Alert::error('Something went wrong!', 'Error!');
        }
    	
    }

    public function getEdit($id) {
    	if (isset($id)) {
            $trips = DB::table('trips')
                ->join('destinations','trips.destination_id','=','destinations.id')
                ->join('categories','trips.category_id','=','categories.id')
                ->select('trips.*','destinations.destName','categories.name')
                ->where('trips.id','=', $id)
                ->get();
            
            $destinations = Destination::all();
            $categories = Category::all();
	        return view('admin.pages.trip.edit', compact('trips','dest','cat','destinations','categories'));
        }        
    }

    public function postEdit(Request $request) {
    	$id = $request->input('s_id');
    	$name = $request->input('name');
        $price = $request->input('price');
        $duration = $request->input('duration');
        $_repeat = $request->input('_repeat');
        $image = $request->input('image');
        $content = $request->input('content');

        for ($i=1; $i <= 5 ; $i++) { 
            $features['feature'.$i] = $request->input('feature'.$i);
        }
        $feature = json_encode($features);

        for ($j=1; $j <= 5 ; $j++) { 
            $includes['include'.$j] = $request->input('include'.$j);
        }
        $include = json_encode($includes);

        $galleryContent = $request->input('galleryContent');
        $galleryVideo = $request->input('galleryVideo');
        $destination_id = $request->input('destination_id');
        $category_id = $request->input('category_id');
        $view = $request->input('view');
        $active = $request->input('active');
        $data = array('tripName' => $name,'price' => $price,'duration' => $duration,'_repeat' => $_repeat, 'content' => $content , 'image' => $image ,
         'features' => $feature ,'include' => $include,'galleryContent' => $galleryContent ,
         'galleryVideo' => $galleryVideo ,'destination_id' => $destination_id,
         'category_id' => $category_id ,'view' => $view,'active' => $active);
    	$T = DB::table('trips')->where('id','=', $id)->update($data);
    	if ($T){
            Alert::success(' The Data Updated successfully', 'Done!');
            $trips = Trip::all();
            return view('admin.pages.trip.index', compact('trips'));
        }else{
            Alert::error('Something went wrong!', 'Error!');
        }
    }

    public function delete($id) {
    	if (isset($id)) {
	    	$T = DB::table('trips')->where('id','=', $id)->delete();
	    	if ($T){
                Alert::success(' The Data Deleted successfully', 'Done!');
                $trips = Trip::all();
                return view('admin.pages.trip.index', compact('trips'));
            }else{
                Alert::error('Something went wrong!', 'Error!');
            }
	    }
    }

}
