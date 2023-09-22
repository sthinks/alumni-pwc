<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;

class AdminProfileController extends Controller
{
    /**
     * @var mixed Config settings
     */
    private $config;

    public function __construct()
    {
        $this->config = Config::get('constants.avatar.image');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        $user = auth()->user();
        return response()->view('admin.profile.settings', [
            'user' => $user,
            'config' => $this->config,
        ]);
    }

    /**
     * Update the user profile
     *
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function update(Request $request): RedirectResponse
    {
        // get the user
        $user = auth()->user();

        // get validated data
        $data = $request->validate($this->rules($user->id), [], $this->attributes());

        // if avatar is uploaded
        if ($request->hasFile('avatar')) {
            // get the file
            $file = $request->file('avatar');

            // get the extension
            $file_extension = $file->getClientOriginalExtension();

            // get the name
            $file_generated_name = Str::uuid() . '.' . $file_extension;

            // move the file
            $file->storePubliclyAs('public/uploads', $file_generated_name);

            // set the avatar
            $data['avatar'] = $file_generated_name;
        }

        // update the user
        $user->update($data);

        return redirect()->route('manager.settings.index')
            ->with('success', 'Profil başarıyla güncellenmiştir.');
    }

    /**
     * Rules for the form
     *
     * @param $id
     *
     * @return array
     */
    public function rules($id): array
    {
        $unique_email_tag = sprintf('unique:users,email,%d', $id);
        $unique_phone_tag = sprintf('unique:users,phone,%d', $id);
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', $unique_email_tag],
            'phone' => ['required', 'string', 'regex:/(5)[0-9]{9}/', $unique_phone_tag, 'max:10'],
            'avatar' => sprintf('nullable|mimes:jpeg,png,jpg|max:%d', $this->config['max_size']),
        ];
    }

    /**
     * Attributes for rules
     *
     * @return array
     */
    public function attributes(): array
    {
        return [
            'name' => 'Ad, soyad',
            'email' => 'Email adresi',
            'phone' => 'Telefon numarası',
            'avatar' => 'Profil Resmi',
        ];
    }
}
