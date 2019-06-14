<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Recommendation;
use DB;
use Alert;

class RecommendationsController extends Controller
{
    public function getIndex() {
    	$recommendations = Recommendation::all();
        return view('admin.pages.recommendation.index', compact('recommendations'));
    }

    public function getAdd() {
        return view('admin.pages.recommendation.add');
    }

    public function postAdd(Request $request) {
        $_head = $request->input('_head');
        $content = $request->input('content');
        $image = $request->input('image');
        $active = $request->input('active');
        $data = array('_head' => $_head ,'content' => $content ,
         'image' => $image ,'active' => $active);
        $R = Recommendation::create($data);
        if ($R){
            Alert::success(' The Data Inserted successfully', 'Done!');
            $recommendations = Recommendation::all();
            return view('admin.pages.recommendation.index', compact('recommendations'));
        }else{
            Alert::error('Something went wrong!', 'Error!');
        }
        
    }

    public function getEdit($id) {
        if (isset($id)) {
            $recommendations = DB::table('recommendations')
                ->select('recommendations.*')
                ->where('id','=', $id)
                ->get();
            return view('admin.pages.recommendation.edit', compact('recommendations'));
        }        
    }

    public function postEdit(Request $request) {
        $id = $request->input('s_id');
        $_head = $request->input('_head');
        $content = $request->input('content');
        $image = $request->input('image');
        $active = $request->input('active');
        $data = array('_head' => $_head ,'content' => $content ,
         'image' => $image ,'active' => $active);
        $R = DB::table('recommendations')->where('id','=', $id)->update($data);
        if ($R){
            Alert::success(' The Data Updated successfully', 'Done!');
            $recommendations = Recommendation::all();
            return view('admin.pages.recommendation.index', compact('recommendations'));
        }else{
            Alert::error('Something went wrong!', 'Error!');
        }
    }

    public function delete($id) {
        if (isset($id)) {
            $R = DB::table('recommendations')->where('id','=', $id)->delete();
            if ($R){
                Alert::success(' The Data Deleted successfully', 'Done!');
                $recommendations = Recommendation::all();
                return view('admin.pages.recommendation.index', compact('recommendations'));
            }else{
                Alert::error('Something went wrong!', 'Error!');
            }
        }
    }

}
