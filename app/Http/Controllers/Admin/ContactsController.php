<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contacts;
use Alert;
use DB;

class ContactsController extends Controller {

	public function getContacts()
    {
        $contacts = DB::table('contacts')
            ->select('contacts.*')
            ->where('id','=', 1)
            ->get();
        return view('admin.pages.contact', compact('contacts','con'));
    }


    public function updateContacts(Request $request)
    {
        $phone = $request->input('phone');
        $orgNum = $request->input('orgNum');
        $vat = $request->input('vat');
        $location = $request->input('location');
        $image = $request->input('image');
        $content = $request->input('content');
        for ($i=1; $i <= 14 ; $i++) { 
            $hours['w'.$i] = $request->input('w'.$i);
        }
        $workingHours = json_encode($hours);
        $google = $request->input('google');
        $facebook = $request->input('facebook');
        $youtube = $request->input('youtube');

        $data = array('phone' => $phone ,'orgNum' => $orgNum ,
         'vat' => $vat ,'location' => $location ,
         'image1' => $image ,'content' => $content ,'workingHours' => $workingHours ,
         'facebook' => $facebook,'google' => $google ,'youtube' => $youtube);
        $c = DB::table('contacts')
            ->where('id', 1)
            ->update($data);

        if ($c){
            Alert::success(' The Data Updated successfully', 'Done!');
            return view('admin.pages.home');
        }else{
            Alert::error('Something went wrong!', 'Error!');
        }
        
    }
}
