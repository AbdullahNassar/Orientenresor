<?php

namespace App\Http\Controllers\Admin\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Mail;

class AuthController extends Controller {

    public function __construct() {
        $this->middleware('guest.admin', ['except' => 'getLogout']);
        // parent::__construct();
    }

    public function getIndex() {
        return view('admin.auth.login');
    }

    public function postLogin(Request $r) {
        // 1- Validator::make()
        // 2- check if fails
        // 3- fails redirect or success not redirect

        $return = [
            'status' => 'success',
            'message' => 'Login Success!',
            'url' => route('admin.home')
        ];

        // grapping admin credentials
        $name = $r->input('email');
        $password = $r->input('password');
        // Searching for the admin matches the passed email or adminname
        $admin = User::where('username', $name)->where('active', 1)->orWhere('email', $name)->first();
//($admin && Hash::check($password, $admin->password))
        if ($admin && Hash::check($password, $admin->password)) {
            // login the admin
            Auth::guard('admins')->login($admin, $r->has('remember'));
        } else {
            $return = [
                'response' => 'error',
                'message' => 'Login Failed!'
            ];
        }
        return response()->json($return);
    }

    /**
     * Logout The user
     */
    public function getLogout() {
        Auth::guard('admins')->logout();
        return redirect('/admin/auth')->with('info', 'Now you are logged out');
    }

}
