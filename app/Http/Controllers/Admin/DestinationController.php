<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Destination;
use App\Continent;
use DB;
use Alert;

class DestinationController extends Controller
{
    public function getIndex() {
    	$destinations = Destination::all();
        return view('admin.pages.destination.index', compact('destinations'));
    }

    public function getAdd() {
        $continents = Continent::all();
        return view('admin.pages.destination.add', compact('continents'));
    }

    public function insert(Request $request) {
    	$name = $request->input('name');
    	$content = $request->input('content');
    	$image = $request->input('image');
        $galleryContent = $request->input('galleryContent');
        $galleryVideo = $request->input('galleryVideo');
        $visaContent = $request->input('visaContent');
        $vaccineContent = $request->input('vaccineContent');
        $continent_id = $request->input('continent_id');
    	$view = $request->input('view');
        $active = $request->input('active');
    	$data = array('destName' => $name ,'content' => $content ,
         'image' => $image ,'galleryContent' => $galleryContent ,
         'galleryVideo' => $galleryVideo , 'visaContent' => $visaContent ,
         'vaccineContent' => $vaccineContent , 'continent_id' => $continent_id ,
         'view' => $view,'active' => $active);
    	$d = Destination::create($data);
        if ($d){
            Alert::success(' The Data Inserted successfully', 'Done!');
            $destinations = Destination::all();
            return view('admin.pages.destination.index', compact('destinations'));
        }else{
            Alert::error('Something went wrong!', 'Error!');
        }
    	
    }

    public function getEdit($id) {
    	if (isset($id)) {
            $destinations = DB::table('destinations')
                ->join('continents','destinations.continent_id','=','continents.id')
                ->select('destinations.*','continents.name')
                ->where('destinations.id','=', $id)
                ->get();
            $continents = Continent::all();
	        return view('admin.pages.destination.edit', compact('destinations','continents'));
        }        
    }

    public function postEdit(Request $request) {
    	$id = $request->input('s_id');
    	$name = $request->input('name');
        $content = $request->input('content');
        $image = $request->input('image');
        $galleryContent = $request->input('galleryContent');
        $galleryVideo = $request->input('galleryVideo');
        $visaContent = $request->input('visaContent');
        $vaccineContent = $request->input('vaccineContent');
        $continent_id = $request->input('continent_id');
        $view = $request->input('view');
        $active = $request->input('active');
        $data = array('destName' => $name ,'content' => $content ,
         'image' => $image ,'galleryContent' => $galleryContent ,
         'galleryVideo' => $galleryVideo , 'visaContent' => $visaContent ,
         'vaccineContent' => $vaccineContent , 'continent_id' => $continent_id ,
         'view' => $view,'active' => $active);
    	$d = DB::table('destinations')->where('id','=', $id)->update($data);
    	if ($d){
            Alert::success(' The Data Updated successfully', 'Done!');
            $destinations = Destination::all();
            return view('admin.pages.destination.index', compact('destinations'));
        }else{
            Alert::error('Something went wrong!', 'Error!');
        }
    }

    public function delete($id) {
    	if (isset($id)) {
	    	DB::table('destinations')->where('id','=', $id)->delete();
	    	if ($d){
                Alert::success(' The Data Deleted successfully', 'Done!');
                $destinations = Destination::all();
                return view('admin.pages.destination.index', compact('destinations'));
            }else{
                Alert::error('Something went wrong!', 'Error!');
            }
	    }
    }

}
