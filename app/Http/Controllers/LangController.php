<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;


class LangController extends Controller {

    public function postIndex(Request $request,$locale) {        
        // if($request->ajax()){
        //     $request->session()->put('locale',$request->locale);
        //     return ['response'=>'success'];
        // }
        $request->session()->put('locale',$locale);
        return back();
    }
}
