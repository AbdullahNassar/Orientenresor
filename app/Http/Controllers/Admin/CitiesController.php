<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\City;
use App\Destination;
use Alert;
use DB;

class CitiesController extends Controller
{
    public function getIndex() {
        $cities = DB::table('cities')
                ->join('destinations', 'cities.destination_id', '=', 'destinations.id')
                ->select('destinations.destName','cities.*')
                ->get();
        $destinations = Destination::all();
        //$city = City::all();
        return view('admin.pages.destination.city.index', compact('cities','destinations'));
    }

    public function insert(Request $request) {
    	$name = $request->input("name");
        $winter = $request->input("winter");
        $spring = $request->input("spring");
        $autumn = $request->input("autumn");
        $summer = $request->input("summer");
        $destination_id = $request->input("destination_id");
        $data = array('name' => $name , 'winter' => $winter ,
                      'spring' => $spring , 'autumn' => $autumn ,
                      'summer' => $summer,'destination_id' => $destination_id);
    	$city = City::create($data);
        if ($city){
            Alert::success(' The Data Inserted successfully', 'Done!');
            return back();
        }else{
            Alert::error('Something went wrong!', 'Error!');
        }
        
    }

    public function postEdit(Request $request) {
        $count = City::count();
        for ($i=1; $i <= $count ; $i++) { 
            $id = $request->input("s_id".$i);
            $name = $request->input("name".$i);
            $winter = $request->input("winter".$i);
            $spring = $request->input("spring".$i);
            $autumn = $request->input("autumn".$i);
            $summer = $request->input("summer".$i);
            $destination_id = $request->input("destination_id".$i);
            $data = array('name' => $name , 'winter' => $winter ,
            'spring' => $spring , 'autumn' => $autumn ,'summer' => $summer,'destination_id' => $destination_id);
            DB::table('cities')->where('id','=', $id)->update($data);
        }   	
        Alert::success(' The Data Updated successfully', 'Done!');
        return back();
    }

    public function delete($id) {
    	if (isset($id)) {
	    	$city = DB::table('cities')->where('id','=', $id)->delete();
	        if ($city){
                Alert::success(' The Data Deleted successfully', 'Done!');
                return back();
            }else{
                Alert::error('Something went wrong!', 'Error!');
            }
	    }
    }

}
