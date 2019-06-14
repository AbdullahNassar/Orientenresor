<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Accomidation;
use Alert;
use DB;

class AccomidationsController extends Controller
{
    public function getIndex() {
        $accomidations = Accomidation::all();
        return view('admin.pages.accomidation.index', compact('accomidations'));
    }

    public function insert(Request $request) {
    	$name = $request->input("name");
        $rate = $request->input("rate");

        $data = array('accname' => $name , 'rate' => $rate);
    	$acc = Accomidation::create($data);
        
        if ($acc){
            Alert::success(' The Data Inserted successfully', 'Done!');
            return back();
        }else{
            Alert::error('Something went wrong!', 'Error!');
        }
    }

    public function postEdit(Request $request) {
        $count = Accomidation::count();
        for ($i=1; $i <= $count ; $i++) { 
            $id = $request->input("s_id".$i);
            $name = $request->input("name".$i);
            $rate = $request->input("rate".$i);

            $data = array('accname' => $name , 'rate' => $rate);
            DB::table('accomidations')->where('id','=', $id)->update($data);
        }   	
        Alert::success(' The Data Updated successfully', 'Done!');
        return back();
    }

    public function delete($id) {
    	if (isset($id)) {
	    	$acc = DB::table('accomidations')->where('id','=', $id)->delete();
	        if ($acc){
                Alert::success(' The Data Deleted successfully', 'Done!');
                return back();
            }else{
                Alert::error('Something went wrong!', 'Error!');
            }
	    }
    }

}
