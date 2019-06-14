<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contacts;
use App\Data;
use DB;

class ProjectsController extends Controller {

	public function getIndex() {

        $projects = DB::table('projects')
            ->join('categories', 'categories.c_id', '=', 'projects.category_id')
            ->select('projects.*','categories.*')
            ->where('active','=', 1)
            ->get();

    	$contact = new Contacts;
    	$data = new Data;
        return view('site.pages.projects', compact('contact','data','projects'));
    }

    public function getProject($id) {

        if (isset($id)) {

        $contact = new Contacts;
        $data = new Data;

        $counts = DB::table('projects')
            ->join('services', 'services.id', '=', 'projects.service_id')
            ->select('projects.*','services.*')
            ->where('projects.active','=', 1)
            ->get();

        $projects = DB::table('projects')
            ->join('services', 'services.id', '=', 'projects.service_id')
            ->join('clients', 'clients.id', '=', 'projects.client_id')
            ->select('projects.*','services.*','clients.*')
            ->where('projects.id','=', $id)
            ->get();

        $g_images = DB::table('gallery')
            ->select('gallery.*')
            ->where('project_id','=', $id)
            ->get();

        return view('site.pages.project', compact('contact','data','counts','projects','g_images'));
        }
    }

}