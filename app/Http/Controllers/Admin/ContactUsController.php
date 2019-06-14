<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contacts;
use Alert;
use DB;

class ContactUsController extends Controller {

	public function getContacts()
    {
        $contacts = DB::table('data')
            ->select('data.*')
            ->where('id','=', 1)
            ->get();
        return view('admin.pages.contact', compact('contacts'));
    }


    public function updateContacts(Request $request)
    {
        $phone = $request->input('phone');
        $email = $request->input('email');
        $contactAddressar = $request->input('contactAddressar');
        $contactAddressen = $request->input('contactAddressen');
        $contactFacebook = $request->input('contactFacebook');
        $contactTwiter = $request->input('contactTwiter');
        $contactGmail = $request->input('contactGmail');
        $contactLinkedin = $request->input('contactLinkedin');

        $data = array('phone' => $phone ,'email' => $email ,
         'address' => $contactAddressar ,'address_en' => $contactAddressen ,
         'facebook' => $contactFacebook ,'twitter' => $contactTwiter ,
         'google' => $contactGmail ,'linkedin' => $contactLinkedin);
        $c = DB::table('data')
            ->where('id', 1)
            ->update($data);

        if ($c){
            Alert::success(' The Data Inserted successfully', 'Done!');
            return back();
        }else{
            Alert::error('Something went wrong!', 'Error!');
        }
        
    }
}
