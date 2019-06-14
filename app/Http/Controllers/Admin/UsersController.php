<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Hash;
use DB;
use Alert;

class UsersController extends Controller {


    public function getIndex() {
        $users = User::get();

        return view('admin.pages.users.index', compact('users'));
    }

    public function getUser($id)
    {
        if (isset($id)) {
            $users = DB::table('users')
                    ->select('users.*')
                    ->where('id', '=', $id)
                    ->get();

        return view('admin.pages.users.edit', compact('users'));
        }
    }

    public function getU($id)
    {
        if (isset($id)) {
        $users = DB::table('users')
                    ->select('users.*')
                    ->where('id', '=', $id)
                    ->get();

        return view('admin.pages.users.delete', compact('users'));
        }
    }

    public function deleteU($id)
    {
        if (isset($id)) {
            DB::table('users')->where('id','=', $id)->delete();
            $users = DB::table('users')
                    ->select('users.*')
                    ->get();

        return view('admin.pages.users.index', compact('users'));
        }
    }

    public function getAdd() {

        $users = DB::table('users')
                    ->select('users.*')
                    ->get();

        return view('admin.pages.users.add', compact('users'));
    }

    public function insertUser(Request $request)
    {
        $name = $request->input('name');
        $username = $request->input('name');
        $email = $request->input('email');
        $password = Hash::make('password');
        $username = $request->input('username');
        $active = $request->input('active');


        $data = array(
            'username'=>$username,
            'name'=>$name,
            'email'=>$email,
            'password'=>$password,
            'active'=>$active
            );

        $U = DB::table('users')->insert($data);
        if ($U){
            Alert::success(' The Data Inserted successfully', 'Done!');
            $users = DB::table('users')
                    ->select('users.*')
                    ->get();

        return view('admin.pages.users.index', compact('users'));
        }else{
            Alert::error('Something went wrong!', 'Error!');
        }
    }

    public function updateUser(Request $request)
    {
        $id = $request->input('s_id');
        $name = $request->input('name');
        $username = $request->input('name');
        $email = $request->input('email');
        $password = Hash::make('password');
        $username = $request->input('username');
        $active = $request->input('active');


        $data = array(
            'username'=>$username,
            'name'=>$name,
            'email'=>$email,
            'password'=>$password,
            'active'=>$active
            );

        $U = DB::table('users')
            ->where('id','=', $id)
            ->update($data);

        if ($U){
            Alert::success(' The Data Updated successfully', 'Done!');
            $users = DB::table('users')
                    ->select('users.*')
                    ->get();

        return view('admin.pages.users.index', compact('users'));
        }else{
            Alert::error('Something went wrong!', 'Error!');
        }

        
    }

}
