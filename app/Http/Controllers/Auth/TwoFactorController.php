<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TwoFactorController
{
    /**
     * @return Response
     */
    public function index(): Response
    {
        $phone = auth()->user()->maskedPhone();
        return response()->view('auth.custom.2fa', [
            'phone' => $phone,
        ]);
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        // Validate the input
        $validatedData = $request->validate(
            [
                'two_factor_code' => 'array|required',
                'two_factor_code.*' => 'integer',
            ],
            [
                'two_factor_code.required' => 'Lütfen tüm alanları doldurunuz.',
                'two_factor_code.*.integer' => 'Lütfen tüm alanları doldurunuz.',
            ]
        );

        // get two factor code
        $inputted_two_factor_code = implode('', $validatedData['two_factor_code']);

        // Get the user
        $user = auth()->user();

        // Check if this code expired
        if (optional($user->two_factor_expires_at)->lt(now())) {
            return response()->json([
                'status' => 'error',
                'msg' => 'Doğrulama kodunuzun kullanım süresi dolmuştur, lütfen yeni bir doğrulama kodu talep ediniz.',
            ]);
        }

        // if the code is correct
        if ($inputted_two_factor_code === $user->two_factor_code) {
            // Delete the code
            $user->resetTwoFactorCode();

            // if user manager send the user
            // to the manager page
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

        return response()->json([
            'status' => 'error',
            'msg' => 'Telefon numaranız doğrulanamadı, lütfen tekrar deneyiniz.',
        ]);
    }

    /**
     * Resend the two factor code
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function resend(Request $request): JsonResponse
    {
        $user = auth()->user();

        // Throttle time interval for requesting a new code
        if (optional($user->two_factor_expires_at)->gt(now())) {
            return response()->json([
                'status' => 'error',
                'msg' => 'Her 2 dakikada bir kez doğrulama kodu talep edebilirsiniz.',
            ]);
        }

        // Generate newly created two factor code
        $user->generateTwoFactorCode();

        // Send that created two factor code via sms
        $user->sendTwoFactorCode();

        return response()->json([
            'status' => 'success',
            'msg' => 'Yeni bir doğrulama kodu telefon numaranıza gönderildi.',
        ]);
    }
}
