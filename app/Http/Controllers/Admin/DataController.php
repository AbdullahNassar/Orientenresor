<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Data;
use DB;
use Alert;

class DataController extends Controller {

	public function getData()
    {
        $statics = DB::table('statics')
            ->select('statics.*')
            ->where('id','=', 1)
            ->get();
        return view('admin.pages.data', compact('statics'));
    }


    public function updateData(Request $request)
    {
        for ($i=1; $i <= 8 ; $i++) { 
            $features['feature'.$i] = $request->input('feature'.$i);
        }
        $feature = json_encode($features);

        $topTrips = $request->input('topTrips');
        $categories = $request->input('categories');
        $recommendations = $request->input('recommendations');
        $blogs = $request->input('blogs');
        $homeFeaturesContent = $request->input('homeFeaturesContent');
        $destinations = $request->input('destinations');
        $climate = $request->input('climate');
        $optionsContent = $request->input('optionsContent');
        $aboutHead = $request->input('aboutHead');
        $aboutContent = $request->input('aboutContent');
        $aboutImage = $request->input('image');
        $teamContent = $request->input('teamContent');
        $goal = $request->input('goal');
        $mission = $request->input('mission');
        $vision = $request->input('vision');
        $benefits = $request->input('benefits');

        $data = array('topTrips' => $topTrips ,'categories' => $categories ,
         'recommendations' => $recommendations ,'blogs' => $blogs ,
         'homeFeaturesContent' => $homeFeaturesContent,'homeFeatures' => $feature,
         'destinations' => $destinations,'climate' => $climate,
         'optionsContent' => $optionsContent,'aboutHead' => $aboutHead,
         'aboutContent' => $aboutContent,'aboutImage' => $aboutImage,
         'teamContent' => $teamContent ,'goal' => $goal,
         'mission' => $mission ,'vision' => $vision,
         'benefits' => $benefits);
        DB::table('statics')
            ->where('id', 1)
            ->update($data);

        Alert::success(' The Data Updated successfully', 'Done!');

        return view('admin.pages.home');
    }
}
