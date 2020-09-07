<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Auth;
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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function adminLogin(Request $request)
    {
        if(strpos($request->email, '@')): $credentials = ['email' => $request->email, 'password' => $request->password];
        else: $credentials = ['username' => $request->email, 'password' => $request->password]; endif;
        if (Auth::attempt($credentials)) {
            // Authentication passed...
            if(Auth::user()->admin_role_id == 4)
            {
                return redirect()->intended('admin/manager/dashboard');
            }
            return redirect()->intended('admin/dashboard');
        } else {
            return redirect()->back()->withErrors(['email' => 'Invalid Login ID or password']);
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/admin/login');
    }
    
}
