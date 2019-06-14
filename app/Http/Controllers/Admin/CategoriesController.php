<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use Alert;
use DB;

class CategoriesController extends Controller
{
    public function getIndex() {
    	$categories = Category::all();
        return view('admin.pages.category.index', compact('categories'));
    }

    public function getAdd() {
        return view('admin.pages.category.add');
    }

    public function insert(Request $request) {
    	$name = $request->input('name');
    	$content = $request->input('content');
    	$image = $request->input('image');
    	$view = $request->input('view');
    	$data = array('name' => $name ,'content' => $content ,
         'image' => $image ,'view' => $view);
    	$category = Category::create($data);

        if ($category){
            Alert::success(' The Data Inserted successfully', 'Done!');
            $categories = Category::all();
            return view('admin.pages.category.index', compact('categories'));
        }else{
            Alert::error('Something went wrong!', 'Error!');
        }
    	
    }

    public function getEdit($id) {
    	if (isset($id)) {
	        $categories = DB::table('categories')
	            ->select('categories.*')
	            ->where('id','=', $id)
	            ->get();
	        return view('admin.pages.category.edit', compact('categories'));
        }        
    }

    public function postEdit(Request $request) {
    	$id = $request->input('s_id');
    	$name = $request->input('name');
    	$content = $request->input('content');
    	$image = $request->input('image');
    	$view = $request->input('view');
    	$data = array('name' => $name ,'content' => $content ,
         'image' => $image ,'view' => $view);
    	$category = DB::table('categories')->where('id','=', $id)->update($data);
    	if ($category){
            Alert::success(' The Data Updated successfully', 'Done!');
            $categories = Category::all();
            return view('admin.pages.category.index', compact('categories'));
        }else{
            Alert::error('Something went wrong!', 'Error!');
        }
    }

    public function delete($id) {
    	if (isset($id)) {
	    	$category = DB::table('categories')->where('id','=', $id)->delete();
	    	if ($category){
                Alert::success(' The Data Deleted successfully', 'Done!');
                $categories = Category::all();
                return view('admin.pages.category.index', compact('categories'));
            }else{
                Alert::error('Something went wrong!', 'Error!');
            }
	    }
    }

}
