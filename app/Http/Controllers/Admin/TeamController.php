<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Team;
use DB;
use Alert;

class TeamController extends Controller
{
    public function getIndex() {
        $teams = Team::all();
        return view('admin.pages.team.index', compact('teams'));
    }

    public function getAdd() {
        return view('admin.pages.team.add');
    }

    public function insert(Request $request) {
        $name = $request->input('name');
        $title = $request->input('title');
        $content = $request->input('content');
        $image = $request->input('image');
        $active = $request->input('active');
        $data = array('name' => $name ,'title' => $title,'content' => $content ,
         'image' => $image ,'active' => $active);
        $T = Team::create($data);
        if ($T){
            Alert::success(' The Data Inserted successfully', 'Done!');
            $teams = Team::all();
            return view('admin.pages.team.index', compact('teams'));
        }else{
            Alert::error('Something went wrong!', 'Error!');
        }
        
    }

    public function getEdit($id) {
        if (isset($id)) {
            $teams = DB::table('teams')
                ->select('teams.*')
                ->where('id','=', $id)
                ->get();
            return view('admin.pages.team.edit', compact('teams'));
        }        
    }

    public function postEdit(Request $request) {
        $id = $request->input('s_id');
        $name = $request->input('name');
        $title = $request->input('title');
        $content = $request->input('content');
        $image = $request->input('image');
        $active = $request->input('active');
        $data = array('name' => $name ,'title' => $title,'content' => $content ,
         'image' => $image ,'active' => $active);
        $T = DB::table('teams')->where('id','=', $id)->update($data);
        if ($T){
            Alert::success(' The Data Updated successfully', 'Done!');
            $teams = Team::all();
            return view('admin.pages.team.index', compact('teams'));
        }else{
            Alert::error('Something went wrong!', 'Error!');
        }
    }

    public function delete($id) {
        if (isset($id)) {
            $T = DB::table('teams')->where('id','=', $id)->delete();
            if ($T){
                Alert::success(' The Data Deleted successfully', 'Done!');
                $teams = Team::all();
                return view('admin.pages.team.index', compact('teams'));
            }else{
                Alert::error('Something went wrong!', 'Error!');
            }
        }
    }

}
