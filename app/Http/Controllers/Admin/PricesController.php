<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Price;
use App\Destination;
use DB;
use Alert;

class PricesController extends Controller
{
    public function getIndex() {
        $prices = Price::all();
        //$order = order::all();
        return view('admin.pages.order.index', compact('prices'));
    }
    
    public function getC(Request $request) {
        $priceDate = $request->input("priceDate");
        // if ($priceDate) {
        //     $prices = Price::find($priceDate)->get();
        //     return view('admin.pages.order.calendar', compact($prices));
        // }
        //$order = order::all();
        return view('admin.pages.order.calendar');
    }

    public function insert(Request $request) {
        $priceDate = $request->input("priceDate");
        $adults = $request->input("adults");
        $children12 = $request->input("children12");
        $children2 = $request->input("children2");
        $singleRoom = $request->input("singleRoom");
        $doubleRoom = $request->input("doubleRoom");
        $data = array('priceDate' => $priceDate , 'adults' => $adults ,
                      'children12' => $children12 , 'children2' => $children2 ,
                      'singleRoom' => $singleRoom,'doubleRoom' => $doubleRoom);
        $p = Price::create($data);
        if ($p){
            Alert::success(' The Data Inserted successfully', 'Done!');
            return back();
        }else{
            Alert::error('Something went wrong!', 'Error!');
        }
        
    }

    public function postEdit(Request $request) {
        $count = Price::count();
        for ($i=1; $i <= $count ; $i++) { 
            $id = $request->input("s_id".$i);
            $priceDate = $request->input("priceDate".$i);
            $adults = $request->input("adults".$i);
            $children12 = $request->input("children12".$i);
            $children2 = $request->input("children2".$i);
            $singleRoom = $request->input("singleRoom".$i);
            $doubleRoom = $request->input("doubleRoom".$i);
            $data = array('priceDate' => $priceDate , 'adults' => $adults ,
            'children12' => $children12 , 'children2' => $children2 ,'singleRoom' => $singleRoom,'doubleRoom' => $doubleRoom);
            DB::table('prices')->where('id','=', $id)->update($data);
        }       
        Alert::success(' The Data Updated successfully', 'Done!');
        return back();
    }

    public function delete($id) {
        if (isset($id)) {
            $p = DB::table('prices')->where('id','=', $id)->delete();
            if ($p){
                Alert::success(' The Data Deleted successfully', 'Done!');
                return back();
            }else{
                Alert::error('Something went wrong!', 'Error!');
            }
        }
    }

}
