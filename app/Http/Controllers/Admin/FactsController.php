<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Fact;
use App\Destination;
use DB;
use Alert;

class FactsController extends Controller
{
    public function getIndex() {
        $facts = DB::table('facts')
                ->join('destinations', 'facts.destination_id', '=', 'destinations.id')
                ->select('destinations.destName','facts.*')
                ->get();
        $destinations = Destination::all();
        //$fact = fact::all();
        return view('admin.pages.destination.fact.index', compact('facts','destinations'));
    }

    public function insert(Request $request) {
    	$capital = $request->input("capital");
        $religion = $request->input("religion");
        $population = $request->input("population");
        $language = $request->input("language");
        $currency = $request->input("currency");
        $area = $request->input("area");
        $destination_id = $request->input("destination_id");
        $data = array('capital' => $capital , 'religion' => $religion ,
                      'population' => $population , 'language' => $language,
                      'currency' => $currency , 'area' => $area,
                      'destination_id' => $destination_id);
    	$f = Fact::create($data);
        if ($f){
            Alert::success(' The Data Inserted successfully', 'Done!');
            return back();
        }else{
            Alert::error('Something went wrong!', 'Error!');
        }
        
    }

    public function postEdit(Request $request) {
        $count = Fact::count();
        for ($i=1; $i <= $count ; $i++) { 
            $id = $request->input("s_id".$i);
            $capital = $request->input("capital".$i);
            $religion = $request->input("religion".$i);
            $population = $request->input("population".$i);
            $language = $request->input("language".$i);
            $currency = $request->input("currency".$i);
            $area = $request->input("area".$i);
            $destination_id = $request->input("destination_id".$i);
            $data = array('capital' => $capital , 'religion' => $religion ,
                          'population' => $population , 'language' => $language,
                          'currency' => $currency , 'area' => $area,
                          'destination_id' => $destination_id);
            DB::table('facts')->where('id','=', $id)->update($data);
        } 
        Alert::success(' The Data Updated successfully', 'Done!');  	
        return back();
    }

    public function delete($id) {
    	if (isset($id)) {
	    	$f = DB::table('facts')->where('id','=', $id)->delete();
	        if ($f){
                Alert::success(' The Data Deleted successfully', 'Done!');
                return back();
            }else{
                Alert::error('Something went wrong!', 'Error!');
            }
	    }
    }

}
