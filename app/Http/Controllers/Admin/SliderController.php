<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Slider;
use DB;
use Alert;

class SliderController extends Controller {

    public function get()
    {
        $sliders = DB::table('sliders')
            ->select('sliders.*')
            ->where('id','=', 1)
            ->get();
        return view('admin.pages.slider', compact('sliders'));
    }

    public function updateSlider(Request $request)
    {
        $image = $request->input('image');

        $data = array('image'=>$image);
        $S = DB::table('sliders')
            ->where('id','=', 1)
            ->update($data);

        if ($S){
            Alert::success(' The Slider Updated successfully', 'Done!');
            return view('admin.pages.home');
        }else{
            Alert::error('Something went wrong!', 'Error!');
        }
        
    }

}
