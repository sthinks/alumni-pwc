<?php

namespace App\Http\Controllers\Register;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PhoneVerificationController extends Controller
{
    public function show(Request $request)
    {
        // format user phone
        $phone = auth()->user()->maskedPhone();

        return $request->user()->hasVerifiedPhone()
            ? redirect()->route('home')
            : view('auth.custom.phone', ['phone' => $phone]);
    }

    public function verify(Request $request)
    {
        // get the user
        $user = auth()->user();

        // Validate the input
        $validatedData = $request->validate(
            [
                'code' => 'array|required',
                'code.*' => 'integer',
            ],
            [
                'code.required' => 'Lütfen tüm alanları doldurunuz.',
                'code.*.integer' => 'Lütfen tüm alanları doldurunuz.',
            ]
        );

        $code = implode('', $validatedData['code']);

        // Check if this code expired
        if ($user->phone_verify_code_expires_at->lt(now())) {
            return response()->json([
                'status' => 'error',
                'msg' => 'Kodunuzun kullanım süresi bitmiştir, lütfen yeni bir kod talep ediniz.',
            ]);
        }

        if ($user->phone_verify_code !== $code) {
            return response()->json([
                'status' => 'error',
                'msg' => 'Telefon numaranız doğrulanamadı, lütfen tekrar deneyiniz.',
            ]);
        }

        // user has verified his number, redirect
        if ($user->hasVerifiedPhone()) {
            return redirect()->route('home');
        }

        // verify his number
        $user->markPhoneAsVerified();

        $redirectTo = $user->isAdmin() ? route('manager.homepage') : route('profile.index');
        // if user is an alumni
        // redirect this user to the
        // profile page
        return response()->json([
            'status' => 'success',
            'msg' => 'Doğrulama yapılmıştır, yönlendiriliyorsunuz.',
            'redirectTo' => $redirectTo,
        ]);
    }

    // resend verification code
    public function resend()
    {
        $user = auth()->user();

        // If user already verified, take this user to the website
        if ($user->hasVerifiedPhone()) {
            return redirect()->route('home');
        }

        // Throttle time interval for requesting a new code
        if (optional($user->phone_verify_code_expires_at)->gt(now())) {
            return response()->json([
                'status' => 'error',
                'msg' => 'Her 2 dakikada bir kez kod talep edebilirsiniz.',
            ]);
        }

        // Generate verification code
        $user->generateVerificationCode();

        // Notify the user with verification code.
        $user->sendVerificationCode();

        return response()->json([
            'status' => 'success',
            'msg' => 'Yeni bir kod telefon numaranıza gönderildi.',
        ]);
    }
}
