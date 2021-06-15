<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function rules()
    {
        return [
            'login' => 'required',
            'password' => 'required'
        ];
    }

    public function login(Request $request)
    {
        $login = $request->login;

        if (filter_var($login, FILTER_VALIDATE_EMAIL)) {
            Auth::attempt(['email' => $login, 'password' => $request->password]);
        } else {
            Auth::attempt(['username' => $login, 'password' => $request->password]);
        }

        if (Auth::check()) {
            //send them where they are going
            return redirect('/');
        }

        return redirect()->route('login')->withErrors([
            'error' => 'These credentials do not match our records.',
        ]);
    }
}
