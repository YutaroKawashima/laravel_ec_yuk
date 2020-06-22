<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers {
        logout as doLogout;
        login as doLogin;
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = 'admin/management';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth_admin')->except('logout');
    // }

    public function showAdminForm(){
        return view('admin.login');
    }

    // public function guard()
    // {
    //     return Auth::guard('admin');
    // }

    public function login(Request $request) {

        if ( $request->name === 'admin' ) {

            $this->doLogin($request);

            return redirect('admin/management');

        } else {

            return $this->doLogin($request);
        }

    }

    public function logout(Request $request) {
        $this->doLogout($request);

        return redirect('/admin/login');
    }
}
