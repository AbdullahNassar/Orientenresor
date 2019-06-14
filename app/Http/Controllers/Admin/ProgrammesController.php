<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Program;
use App\Trip;
use DB;
use Alert;

class ProgrammesController extends Controller
{
    public function getIndex() {
    	$programmes = DB::table('programmes')
                ->select('programmes.*')
                ->get();
        return view('admin.pages.trip.program.index', compact('programmes'));
    }

    public function getAdd() {
        $trips = Trip::all();
        $programmes = DB::table('programmes')
                ->select('programmes.*')
                ->get();
        return view('admin.pages.trip.program.add', compact('trips'));
    }

    public function insert(Request $request) {
    	$name = $request->input('name');
        $content = $request->input('content');
        $destination = $request->input('destination');
        $visit = $request->input('visit');
        $transportation = $request->input('transportation');
        $distance = $request->input('distance');
        $cuisines = $request->input('cuisines');
        $residence = $request->input('residence');
        $trip_id = $request->input('trip_id');
        $view = $request->input('view');
        $active = $request->input('active');

    	$data = array('name' => $name, 'content' => $content ,
                      'destination' => $destination , 'visit' => $visit ,
                      'transportation' => $transportation, 'distance' => $distance ,
                      'cuisines' => $cuisines,'residence' => $residence ,
                      'trip_id' => $trip_id ,'view' => $view,'active' => $active);

    	$p = DB::table('programmes')->insert($data);
        if ($p){
            Alert::success(' The Data Inserted successfully', 'Done!');
            $programmes = DB::table('programmes')
                ->select('programmes.*')
                ->get();
            return view('admin.pages.trip.program.index', compact('programmes'));
        }else{
            Alert::error('Something went wrong!', 'Error!');
        }
    	
    }

    public function getEdit($id) {
    	if (isset($id)) {
            $programmes = DB::table('programmes')
                ->join('trips','programmes.trip_id','=','trips.id')
                ->select('programmes.*','trips.tripName')
                ->where('programmes.id','=', $id)
                ->get();
            $trips = Trip::all();
            $images = DB::table('programimages')
                ->select('programimages.*')
                ->where('program_id','=', $id)
                ->get();
	        return view('admin.pages.trip.program.edit', compact('programmes','trips','images'));
        }        
    }

    public function postEdit(Request $request) {
    	$id = $request->input('s_id');
    	$name = $request->input('name');
        $content = $request->input('content');
        $destination = $request->input('destination');
        $visit = $request->input('visit');
        $transportation = $request->input('transportation');
        $distance = $request->input('distance');
        $cuisines = $request->input('cuisines');
        $residence = $request->input('residence');
        $trip_id = $request->input('trip_id');
        $view = $request->input('view');
        $active = $request->input('active');

        $data = array('name' => $name, 'content' => $content ,
                      'destination' => $destination , 'visit' => $visit ,
                      'transportation' => $transportation, 'distance' => $distance ,
                      'cuisines' => $cuisines,'residence' => $residence ,
                      'trip_id' => $trip_id ,'view' => $view,'active' => $active);

    	$p = DB::table('programmes')->where('id','=', $id)->update($data);
    	if ($p){
            Alert::success(' The Data Updated successfully', 'Done!');
            $programmes = DB::table('programmes')
                ->select('programmes.*')
                ->get();
            return view('admin.pages.trip.program.index', compact('programmes'));
        }else{
            Alert::error('Something went wrong!', 'Error!');
        }
    }

    public function delete($id) {
    	if (isset($id)) {
	    	$p = DB::table('programmes')->where('id','=', $id)->delete();
	    	if ($p){
                Alert::success(' The Data Deleted successfully', 'Done!');
                $programmes = DB::table('programmes')
                ->select('programmes.*')
                ->get();
                return view('admin.pages.trip.program.index', compact('programmes'));
            }else{
                Alert::error('Something went wrong!', 'Error!');
            }
	    }
    }

    public function getPostImages(Request $request) {
        $id = $request->input('program');
        $image = $request->file('file');
        if ($image) {
            $destination = storage_path('uploads/program/');
            $imageName = $image->getClientOriginalName();
            $image->move($destination, $imageName);
            $image_path = "storage/uploads/program".'/'.$imageName;
            $data = array('image'=>$image_path,'program_id'=>$id);
            DB::table('programimages')->insert($data);
        }
    }

    public function addImages(Request $request) {
        $id = $request->input('program_id');
        $image = $request->file('file');
        if ($image) {
            $destination = storage_path('uploads/program/');
            $imageName = $image->getClientOriginalName();
            $image->move($destination, $imageName);
            $image_path = "storage/uploads/program".'/'.$imageName;
            $data = array('image'=>$image_path,'program_id'=>$id);
            DB::table('programimages')->insert($data);
        }
    }

    public function deleteImage($id)
    {
        if (isset($id)) {
            DB::table('programimages')->where('id','=', $id)->delete();
            return back();
        }
    }

    public function getGallery() {
        $programmes = DB::table('programmes')
            ->select('programmes.*')
            ->orderBy('id')
            ->get();

        return view('admin.pages.trip.program.gallery', compact('programmes'));
    }

}
