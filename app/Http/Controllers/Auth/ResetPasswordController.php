<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Rules\NotInPasswordHistory;
use App\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Display the password reset view for the given token.
     *
     * If no token is present, display the link request form.
     *
     * @param Request $request
     * @param string|null $token
     *
     * @return Factory|View
     */
    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.custom.resetpw')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    /**
     * Reset the given user's password.
     *
     * @param Request $request
     *
     * @return RedirectResponse|JsonResponse
     */
    public function reset(Request $request)
    {
        $user_email = $request->get('email');

        $userQuery = User::where('email', $user_email);

        if ($userQuery->count() === 0) {
            return redirect()->back()->withErrors([
                'email' => 'Email adresini yanlış girdiniz.',
            ]);
        }

        $user = $userQuery->first();

        $rules = $user->isAdmin() ? $this->adminRules($user) : $this->alumniRules($user);

        $request->validate($rules, $this->validationErrorMessages());

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $response = $this->broker()->reset(
            $this->credentials($request),
            function ($user, $password) {
                $this->resetPassword($user, $password);
            }
        );

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        return $response === Password::PASSWORD_RESET
            ? $this->sendResetResponse($request, $response)
            : $this->sendResetFailedResponse($request, $response);
    }

    /**
     * Get the validation rules that apply to the request for alumni user
     *
     * @return array
     */
    public function adminRules($user)
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => ['required', new NotInPasswordHistory($user), 'string', 'min:20', 'confirmed', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'regex:/[@$!%*#?&]/'],
        ];
    }

    /**
     * Get the validation rules that apply to the request for alumni user
     *
     * @return array
     */
    public function alumniRules($user)
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => ['required', new NotInPasswordHistory($user), 'string', 'min:10', 'confirmed', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'regex:/[@$!%*#?&]/'],
        ];
    }

    protected function resetPassword($user, $password)
    {
        $this->setUserPassword($user, $password);

        $user->setRememberToken(Str::random(60));

        $user->save();

        // save password in password history
        $user->passwordHistory()->create(['password' => $user->password]);

        event(new PasswordReset($user));

        Cookie::queue('password_reset', true, 1);

        return redirect('login')->with('status', 'Şifreniz başarıyla güncellenmiştir.');
    }
}
