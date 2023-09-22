<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Display the form to request a password reset link.
     *
     * @return View
     */
    public function showLinkRequestForm()
    {
        return view('auth.custom.forgotpw');
    }
    public function showLinkRequest2Form()
    {
        return view('auth.custom.forgotpw2');
    }
    public function showLinkRequest3Form()
    {
        return view('auth.custom.forgotpw3');
    }

    /**
     * Get the response for a successful password reset link.
     *
     * @param Request $request
     * @param string $response
     *
     * @return RedirectResponse|JsonResponse
     */
    protected function sendResetLinkResponse(Request $request, $response)
    {
        // log this activity
        $email = $request->input('email');
        $user = User::where('email', $email)->first();
        activity(config('activitylog.auth_logs.name'))
            ->performedOn($user)
            ->withProperties(['ip' => $request->ip(), 'user_agent' => $request->userAgent()])
            ->log(config('activitylog.auth_logs.password_reset_request'));

        return $request->wantsJson()
            ? new JsonResponse(['message' => trans($response)], 200)
            : redirect('login')->with('status', trans($response));
    }
}
