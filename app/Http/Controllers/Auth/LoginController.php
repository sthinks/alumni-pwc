<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\View\View;

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
    protected $maxAttempts = 5;
    protected $decayMinutes = 5;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // Protect from brute force

    /**
     * Show the application's login form.
     *
     * @return View
     */
    public function showLoginForm()
    {
        return view('auth.custom.login');
    }
    public function showLogin2Form()
    {
        return view('auth.custom.login2');
    }
    public function showLogin3Form()
    {
        return view('auth.custom.login3');
    }
    /**
     * The user has been authenticated.
     *
     * @param Request $request
     * @param mixed $user
     *
     * @return void
     */
    protected function authenticated(Request $request, $user)
    {

        \Auth::logoutOtherDevices(request('password'));

        // If user hasn't verified phone yet...
        if (! $user->hasVerifiedPhone()) {
            $user->generateVerificationCode();
            $user->sendVerificationCode();
        } else {
            $user->generateTwoFactorCode();
            $user->sendTwoFactorCode();
        }
    }
}
