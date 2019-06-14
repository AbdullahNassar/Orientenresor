<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use DB;
use Alert;

class PostsController extends Controller
{
    public function getIndex() {
    	$posts = Post::all();
        return view('admin.pages.post.index', compact('posts'));
    }

    public function getAdd() {
        return view('admin.pages.post.add');
    }

    public function insert(Request $request) {
        $_head = $request->input('_head');
        $content = $request->input('content');
        $image = $request->input('image');
        $view = $request->input('view');
        $data = array('_head' => $_head ,'content' => $content ,
         'image' => $image ,'view' => $view);
        $p = Post::create($data);
        if ($p){
            Alert::success(' The Data Inserted successfully', 'Done!');
            $posts = Post::all();
            return view('admin.pages.post.index', compact('posts'));
        }else{
            Alert::error('Something went wrong!', 'Error!');
        }
        
    }

    public function getEdit($id) {
        if (isset($id)) {
            $posts = DB::table('posts')
                ->select('posts.*')
                ->where('id','=', $id)
                ->get();
            return view('admin.pages.post.edit', compact('posts'));
        }        
    }

    public function postEdit(Request $request) {
        $id = $request->input('s_id');
        $_head = $request->input('_head');
        $content = $request->input('content');
        $image = $request->input('image');
        $view = $request->input('view');
        $data = array('_head' => $_head ,'content' => $content ,
         'image' => $image ,'view' => $view);
        $p = DB::table('posts')->where('id','=', $id)->update($data);
        if ($p){
            Alert::success(' The Data Updated successfully', 'Done!');
            $posts = Post::all();
            return view('admin.pages.post.index', compact('posts'));
        }else{
            Alert::error('Something went wrong!', 'Error!');
        }
    }

    public function delete($id) {
        if (isset($id)) {
            $p = DB::table('posts')->where('id','=', $id)->delete();
            if ($p){
                Alert::success(' The Data Deleted successfully', 'Done!');
                $posts = Post::all();
                return view('admin.pages.post.index', compact('posts'));
            }else{
                Alert::error('Something went wrong!', 'Error!');
            }
        }
    }

}
