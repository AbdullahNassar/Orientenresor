<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Destination;
use App\Accomidation;
use App\Camp;
use Alert;
use DB;

class CampsController extends Controller
{
    public function getIndex() {
    	$camps = Camp::all();
        return view('admin.pages.destination.camp.index', compact('camps'));
    }

    public function getAdd() {
        $destinations = Destination::all();
        $accomidations = Accomidation::all();
        return view('admin.pages.destination.camp.add', compact('destinations','accomidations'));
    }

    public function postAdd(Request $request) {
        $name = $request->input('name');
        $rate = $request->input('rate');
        $image = $request->input('image');
        $active = $request->input('active');
        $destination_id = $request->input('destination_id');
        $accomidation_id = $request->input('accomidation_id');
        $data = array('name' => $name ,'rate' => $rate ,
         'image' => $image ,'active' => $active, 'destination_id' => $destination_id ,
         'accomidation_id' => $accomidation_id);
        $camp = Camp::create($data);
        if ($camp){
            Alert::success(' The Data Inserted successfully', 'Done!');
            $camps = Camp::all();
            return view('admin.pages.destination.camp.index', compact('camps'));
        }else{
            Alert::error('Something went wrong!', 'Error!');
        }
        
    }

    public function getEdit($id) {
        if (isset($id)) {
            $camps = DB::table('camps')
                ->join('destinations','camps.destination_id','=','destinations.id')
                ->join('accomidations','camps.accomidation_id','=','accomidations.id')
                ->select('camps.*','destinations.destName','accomidations.accname')
                ->where('camps.id','=', $id)
                ->get();
            $destinations = Destination::all();
            $accomidations = Accomidation::all();
            return view('admin.pages.destination.camp.edit', compact('camps','destinations','accomidations'));
        }        
    }

    public function postEdit(Request $request) {
        $id = $request->input('s_id');
        $name = $request->input('name');
        $rate = $request->input('rate');
        $image = $request->input('image');
        $active = $request->input('active');
        $destination_id = $request->input('destination_id');
        $accomidation_id = $request->input('accomidation_id');
        $data = array('name' => $name ,'rate' => $rate ,
         'image' => $image ,'active' => $active, 'destination_id' => $destination_id ,
         'accomidation_id' => $accomidation_id);
        $camp = DB::table('camps')->where('id','=', $id)->update($data);
        if ($camp){
            Alert::success(' The Data Updated successfully', 'Done!');
            $camps = Camp::all();
            return view('admin.pages.destination.camp.index', compact('camps'));
        }else{
            Alert::error('Something went wrong!', 'Error!');
        }
    }

    public function delete($id) {
        if (isset($id)) {
            $camp = DB::table('camps')->where('id','=', $id)->delete();
            if ($camp){
                Alert::success(' The Data Deleted successfully', 'Done!');
                $camps = Camp::all();
                return view('admin.pages.destination.camp.index', compact('camps'));
            }else{
                Alert::error('Something went wrong!', 'Error!');
            }
        }
    }

}
