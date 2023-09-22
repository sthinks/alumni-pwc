<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\SecondMailVerify;
use App\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VerifySecondMailController extends Controller
{
    /**
     * Verify the token
     *
     * @param Request $request
     * @param $token
     *
     * @return RedirectResponse
     *
     * @throws Exception
     */
    public function verify(Request $request, $token): RedirectResponse
    {
        // validate the data
        $validator = Validator::make($request->route()->parameters, [
            'token' => 'required|exists:second_mail_verifies,token',
        ]);

        // if validation fails, throw an exception
        if ($validator->fails()) {
            abort(403);
        }

        // get the token
        $token = SecondMailVerify::where('token', $token)->firstOrFail();

        // check if the token is expired
        if (now()->diffInMinutes($token->created_at) > 60) {
            return redirect()->route('profile.index')
                ->withErrors('Link kullanım süresi dolmuştur.');
        }

        // mark user second mail adress as verified
        $user = User::findOrFail($token->user_id);
        $user->timestamps = false;
        $user->second_mail_verified_at = $user->freshTimestamp();

        // save the changes
        if ($user->save()) {
            $token->delete();
        }

        // redirect to the profile page
        return redirect()->route('profile.index');
    }

    /**
     * Resend second mail verification
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function resend(Request $request)
    {
        $user = auth()->user();
        if (! filter_var($user->second_mail, FILTER_VALIDATE_EMAIL)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Lütfen geçerli bir e-mail adresi giriniz.',
            ]);
        }
        $user->sendSecondEmailVerificationNotification();
        return response()->json([
            'status' => 'success',
            'message' => 'İş e-mail adresi doğrulama linki gönderildi.',
        ], 200);
    }
}
