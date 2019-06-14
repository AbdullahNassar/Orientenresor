<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Cruise;
use App\Destination;
use App\Accomidation;
use Alert;
use DB;

class CruisesController extends Controller
{
    public function getIndex() {
    	$cruises = Cruise::all();
        return view('admin.pages.destination.cruise.index', compact('cruises'));
    }

    public function getAdd() {
        $destinations = Destination::all();
        $accomidations = Accomidation::all();
        return view('admin.pages.destination.cruise.add', compact('destinations','accomidations'));
    }

    public function insert(Request $request) {
    	$name = $request->input('name');
    	$image = $request->input('image');
        $rate = $request->input('rate');
        $destination_id = $request->input('destination_id');
        $accomidation_id = $request->input('accomidation_id');
        $active = $request->input('active');
    	$data = array('name' => $name , 'image' => $image ,
         'rate' => $rate , 'destination_id' => $destination_id ,
         'accomidation_id' => $accomidation_id ,'active' => $active);
    	$c = Cruise::create($data);
        if ($c){
            Alert::success(' The Data Inserted successfully', 'Done!');
            $cruises = Cruise::all();
            return view('admin.pages.destination.cruise.index', compact('cruises'));
        }else{
            Alert::error('Something went wrong!', 'Error!');
        }
    	
    }

    public function getEdit($id) {
    	if (isset($id)) {
            $cruises = DB::table('cruises')
                ->join('destinations','cruises.destination_id','=','destinations.id')
                ->join('accomidations','cruises.accomidation_id','=','accomidations.id')
                ->select('cruises.*','destinations.destName','accomidations.accname')
                ->where('cruises.id','=', $id)
                ->get();
            $destinations = Destination::all();
            $accomidations = Accomidation::all();
	        return view('admin.pages.destination.cruise.edit', compact('cruises','dest','acco','destinations','accomidations'));
        }        
    }

    public function postEdit(Request $request) {
    	$id = $request->input('s_id');
    	$name = $request->input('name');
        $image = $request->input('image');
        $rate = $request->input('rate');
        $destination_id = $request->input('destination_id');
        $accomidation_id = $request->input('accomidation_id');
        $active = $request->input('active');
        $data = array('name' => $name , 'image' => $image ,
         'rate' => $rate , 'destination_id' => $destination_id ,
         'accomidation_id' => $accomidation_id ,'active' => $active);
    	$c = DB::table('cruises')->where('id','=', $id)->update($data);
    	if ($c){
            Alert::success(' The Data Updated successfully', 'Done!');
            $cruises = Cruise::all();
            return view('admin.pages.destination.cruise.index', compact('cruises'));
        }else{
            Alert::error('Something went wrong!', 'Error!');
        }
    }

    public function delete($id) {
    	if (isset($id)) {
	    	$c = DB::table('cruises')->where('id','=', $id)->delete();
	    	if ($c){
                Alert::success(' The Data Deleted successfully', 'Done!');
                $cruises = Cruise::all();
                return view('admin.pages.destination.cruise.index', compact('cruises'));
            }else{
                Alert::error('Something went wrong!', 'Error!');
            }
	    }
    }

}
