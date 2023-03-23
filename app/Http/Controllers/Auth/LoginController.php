<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Auth\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\LoginNotif;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Mail\BienvenidaCorreo;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function auth(Request $request, $user)
    {
        mail::to($user->email)->send(new LoginNotif($user));
        
    }
}
