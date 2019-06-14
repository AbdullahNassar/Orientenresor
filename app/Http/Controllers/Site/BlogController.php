<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contacts;
use App\About;
use App\Data;
use DB;

class BlogController extends Controller {

    public function getIndex() {

        $contact = new Contacts;
    	$data = new Data;
    	$abouts = new About;

        $posts = DB::table('posts')
            ->join('users', 'users.id', '=', 'posts.user_id')
            ->select('posts.*','users.name','users.name_en')
            ->where('posts.active','=', 1)
            ->get();

        return view('site.pages.posts',compact('contact','abouts','data','posts'));
    }

    public function getPost($id) {

        if (isset($id)) {

        $contact = new Contacts;
        $data = new Data;
        $abouts = new About;

        $posts = DB::table('posts')
            ->join('users', 'users.id', '=', 'posts.user_id')
            ->where('posts.id','=', $id)
            ->select('posts.*','users.name','users.name_en')
            ->get();

        $counts = DB::table('posts')
            ->select('posts.*')
            ->where('posts.active','=', 1)
            ->get();

        $comments = DB::table('comments')
            ->join('posts', 'posts.id', '=', 'comments.post_id')
            ->select('comments.*')
            ->where('posts.id','=', $id)
            ->get();

        return view('site.pages.post', compact('contact','abouts','data','posts','counts','comments'));
        }
    }

    public function comment(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $comment = $request->input('comment');
        $id = $request->input('id');
        $data = array('name'=>$name,
            'email'=>$email,'comment'=>$comment,'post_id'=>$id);

        DB::table('comments')->insert($data);
        return back();
    }

}
