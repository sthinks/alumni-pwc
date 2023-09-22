<?php

namespace App\Http\Controllers;

use App\Rules\MatchOldPassword;
use App\Rules\NotInPasswordHistory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AdminPasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        return response()->view('admin.profile.password');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function update(Request $request): RedirectResponse
    {
        // Get validated data
        $data = $request->validate(
            $this->rules(),
            [],
            $this->attributes()
        );

        // Update user password
        $user = auth()->user();
        $new_password = Hash::make($data['new_password']);
        $user->password = $new_password;

        if ($user->save()) {
            $user->passwordHistory()->create(['password' => $new_password]);
            return redirect()->back()
                ->with('success', 'Şifreniz başarıyla güncellenmiştir.');
        }
        return redirect()->back()
            ->withErrors('Şifre güncellenirken bir hata oluştu.');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'old_password' => ['required', new MatchOldPassword()],
            'new_password' => ['required', new NotInPasswordHistory(auth()->user()), 'string', 'min:20', 'confirmed', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'regex:/[@$!%*#?&]/'],
        ];
    }

    public function attributes(): array
    {
        return [
            'old_password' => 'Eski şifre',
            'new_password' => 'Yeni şifre',
        ];
    }
}
