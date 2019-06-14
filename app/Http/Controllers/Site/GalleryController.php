<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Gallery;
use App\Contacts;
use App\About;
use App\Data;
use DB;

class GalleryController extends Controller {

    public function getIndex() {

    	$contact = new Contacts;
        $data = new Data;
        $abouts = new About;

        $categories = DB::table('categories')
            ->select('categories.*')
            ->get();

        $images = DB::table('gallery')
            ->join('categories', 'categories.id', '=', 'gallery.category_id')
            ->select('gallery.image','categories.name','categories.name_en','categories.type')
            ->get();

        return view('site.pages.gallery', compact('contact','abouts','data','categories','images'));
    }

    public function getImg($id) {

        if (isset($id)) {

        $contact = new Contacts;
        $data = new Data;
        $abouts = new About;

        $categories = DB::table('categories')
            ->select('categories.*')
            ->get();

        $images = DB::table('gallery')
            ->join('categories', 'categories.id', '=', 'gallery.category_id')
            ->select('gallery.image','categories.name','categories.name_en')
            ->where('categories.id', '=', $id)
            ->get();

        return view('site.pages.gallery', compact('contact','abouts','data','categories','images'));
        }
    }

}
