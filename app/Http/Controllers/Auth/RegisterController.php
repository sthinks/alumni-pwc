<?php

namespace App\Http\Controllers\Auth;

use App\Enums\TermConditionType;
use App\Http\Controllers\Controller;
use App\Permission;
use App\Providers\RouteServiceProvider;
use App\Rules\PasswordSpecialCharacter;
use App\TermCondition;
use App\User;
use App\UserTerm;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Show the application registration form.
     *
     * @return View
     */
    public function showRegistrationForm(): View
    {
        return view('auth.custom.register', [
            'allowed_chars' => PasswordSpecialCharacter::ALLOWEDCHARS,
        ]);
    }
    public function showRegistration2Form(): View
    {
        return view('auth.custom.register2', [
            'allowed_chars' => PasswordSpecialCharacter::ALLOWEDCHARS,
        ]);
    }
    public function showRegistration3Form(): View
    {
        return view('auth.custom.register3', [
            'allowed_chars' => PasswordSpecialCharacter::ALLOWEDCHARS,
        ]);
    }
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'phone.unique' => 'Bu numaraya tanımlı bir hesap bulunmaktadır. Lütfen farklı bir numara giriniz.',
        ];
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:10', 'confirmed', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', new PasswordSpecialCharacter()],
            'phone' => ['required', 'string', 'unique:users'],
            'birthdate' => ['required', 'date'],
            'pwc_join_year' => ['required', 'date'],
            'linkedin' => ['nullable', 'url'],
            TermConditionType::ClarificationText => ['required'],
            TermConditionType::UserAgreement => ['required']
        ], $this->messages());
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     *
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'],
            'birthdate' => $data['birthdate'],
            'pwc_join_year' => $data['pwc_join_year'],
            'linkedin' => $data['linkedin'],
        ]);
    }

    /**
     * The user has been registered.
     *
     * @param Request $request
     * @param mixed $user
     *
     * @return void
     */
    protected function registered(Request $request, User $user)
    {
        // Generate verification code
        $user->generateVerificationCode();

        // Notify the user with verification code.
        $user->sendVerificationCode();

        // Mark user permissions
        $consent = $request->has('acik-riza-metni');
        $this->fillPermission($user, $consent);
        if($request->has(TermConditionType::UserAgreement)) {
            $user->termAndConditions()->attach(TermCondition::whereType(TermConditionType::UserAgreement)->latest()->first());
        }
        if($request->has(TermConditionType::ClarificationText)) {
            $user->termAndConditions()->attach(TermCondition::whereType(TermConditionType::ClarificationText)->latest()->first());
        }
    }

    /**
     * Fill user permissions before-hand
     *
     * @param User $user
     * @param bool $consent
     */
    protected function fillPermission(User $user, bool $consent)
    {
        if ($consent) {
            foreach (Permission::whereIn('slug', ['pwc-alumni', 'pwc-turkiye'])->get() as $permission) {
                $permission->users()->attach($user);
            }
        }
    }
}
