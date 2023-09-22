<?php

namespace App\Http\Controllers\Alumni;

use App\Events\ProfileUpdated;
use App\Http\Controllers\Controller;
use App\Permission;
use App\Rules\MatchOldPassword;
use App\Rules\NotInPasswordHistory;
use App\Skill;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserUpdatedAccount;

class ProfileUpdateController extends Controller
{
    /**
     * @var mixed Config settings
     */
    private $config;

    public function __construct()
    {
        $this->config = Config::get('constants.avatar.image');
    }


    public function index(Request $request)
    {
        $user = $request->user();
        $pwc_join_year = isset($user->pwc_join_year) ? $user->pwc_join_year->format('Y') : '?';
        $pwc_quit_year = isset($user->pwc_quit_year) ? $user->pwc_quit_year->format('Y') : '?';
        $user->pwc_worked_between = sprintf('%s - %s', $pwc_join_year, $pwc_quit_year);

        $hobbies = $user->hobbies()->get();

        // permissions
        $pwc_permissions = Permission::where('group', Permission::GROUP_PWC)->get();

        $pwc_permissions->map(function ($permission) use ($user) {
            $permission->allowed = $permission->users->contains($user->id);
            return $permission;
        });

        // alumni permissions
        $alumni_permissions = Permission::where('group', Permission::GROUP_ALUMNI)->get();
        $alumni_permissions->map(function ($permission) use ($user) {
            $permission->allowed = $permission->users->contains($user->id);
            return $permission;
        });

        return view('alumni.profile.index', [
            'user' => $user,
            'config' => $this->config,
            'hobbies' => $hobbies,
            'alumni_permissions' => $alumni_permissions,
            'pwc_permissions' => $pwc_permissions,
        ]);
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     *
     * @throws ValidationException
     */
    public function update(Request $request): JsonResponse
    {
        // get user
        $user = $request->user();

        // validate data
        $validate = Validator::make(
            $request->all(),
            $this->rules($user),
            [],
            $this->attributes()
        );
        // if validation fails
        if ($validate->fails()) {
            return response()->json(['status' => 'error', 'data' => $validate->errors()]);
        }

        // update user
        $validated_data = $validate->validated();

        // convert pwc worked office value to id
        if (isset($validated_data['pwc_worked_office'])) {
            $validated_data['pwc_worked_office'] = DB::table('pwc_offices')->where('name', $validated_data['pwc_worked_office'])->first()->id;
        }

        // convert pwc team-sub value to id
        if (isset($validated_data['pwc_worked_team_los'])) {
            $validated_data['pwc_worked_team_los'] = DB::table('pwc_los')->where('name', $validated_data['pwc_worked_team_los'])->first()->id;
        }

        // convert pwc team-sublos value to id
        if (isset($validated_data['pwc_worked_team_sublos'])) {
            $validated_data['pwc_worked_team_sublos'] = DB::table('pwc_sublos')->where('name', $validated_data['pwc_worked_team_sublos'])->first()->id;
        }

        // convert pwc legacy value to id
        if (isset($validated_data['legacy'])) {
            $validated_data['legacy'] = DB::table('legacies')->where('name', $validated_data['legacy'])->first()->id;
        }

        // check if avatar changed
        if ($request->hasFile('avatar')) {
            // Get the image
            $image = $request->file('avatar');

            // Assign image name
            $imageName = sprintf('avatar-%s.%s', Str::uuid(), $image->extension());

            // Upload the image
            $image->storePubliclyAs('public/uploads', $imageName);

            // Save image name
            $validated_data['avatar'] = $imageName;
        }

        $user->update($validated_data);

        if ($user->wasChanged('phone')) {
            // Generate verification code
            $user->generateVerificationCode();

            // Notify the user with verification code.
            $user->sendVerificationCode();

            $user->phone_verified_at = null;

            $user->save();
        }
        // notify the admin
        Mail::send(new UserUpdatedAccount($user));
        return response()->json([
            'status' => 'success',
            'data' => 'Başarıyla güncellenmiştir.',
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @param User $user
     *
     * @return array
     */
    public function rules(User $user): array
    {
        return [
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'second_mail' => 'nullable|string|max:255|unique:users,second_mail,' . $user->id,
            'phone' => 'required|string|unique:users,phone,' . $user->id,
            'home_address' => 'nullable|string|max:1027',
            'name' => 'nullable|string|max:255',
            'second_surname' => 'nullable|string|max:255',
            'linkedin' => 'nullable|string|max:255',
            'legacy' => 'nullable|string|max:255',
            'pwc_join_year' => 'nullable|date',
            'pwc_quit_year' => 'nullable|date',
            'pwc_worked_office' => 'nullable|string|max:255|exists:pwc_offices,name',
            'pwc_worked_team_los' => 'nullable|string|max:255',
            'pwc_worked_team_sublos' => 'nullable|string|max:255',
            'current_work_sector' => 'nullable|string|max:255',
            'current_work_company' => 'nullable|string|max:255',
            'current_work_role' => 'nullable|string|max:255',
            'university' => 'nullable|string|max:255',
            'birthdate' => 'nullable|date',
            'avatar' => sprintf('nullable|mimes:jpeg,png,jpg|max:%d', $this->config['max_size']),
        ];
    }

    /**
     * Attrbiutes for fields
     *
     * @return array
     */
    public function attributes(): array
    {
        return [
            'email' => 'Kişisel Email',
            'second_mail' => 'İş E-mail',
            'phone' => 'Telefon Numarası',
            'home_address' => 'Ev Adresi',
            'linkedin' => 'Linkedin Hesabı',
            'legacy' => 'Legacy',
            'pwc_join_year' => "PwC'ye İlk Katılma Yılı",
            'pwc_quit_year' => "PwC'den Ayrıldığı Tarihi",
            'pwc_worked_office' => "PwC'de Çalıştığı Ofis",
            'pwc_worked_team_los' => "PwC'de Çalıştığı Ekip Los",
            'pwc_worked_team_sublos' => "PwC'de Çalıştığı Ekip SubLos",
            'current_work_sector' => 'Çalıştığı Sektör',
            'current_work_company' => 'Çalıştığı Şirket',
            'current_work_role' => 'Çalıştığı Şirketteki Rolü (Ünvanı)',
            'university' => 'Üniversite',
        ];
    }

    /**
     * Update the password in storage.
     *
     * @param Request $request
     *
     * @return JsonResponse
     *
     * @throws ValidationException
     */
    public function password(Request $request): JsonResponse
    {
        // Get validated data
        $validator = Validator::make(
            $request->all(),
            $this->passwordRules(),
            [],
            $this->passwordAttributes()
        );

        // if validation fails
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'data' => $validator->errors()]);
        }

        // validated data
        $data = $validator->validated();

        // Update user password
        $user = auth()->user();
        $new_password = Hash::make($data['new_password']);
        $user->password = $new_password;

        if ($user->save()) {
            $user->passwordHistory()->create(['password' => $new_password]);
            return response()->json([
                'status' => 'success',
                'data' => 'Şifreniz başarıyla güncellenmiştir.',
            ]);
        }

        return response()->json([
            'status' => 'error',
            'data' => 'Şifreniz güncellenirken bir hata oluştu.',
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function passwordRules(): array
    {
        return [
            'old_password' => ['required', new MatchOldPassword()],
            'new_password' => ['required', new NotInPasswordHistory(auth()->user()), 'string', 'min:10', 'confirmed', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'regex:/[@$!%*#?&]/'],
        ];
    }

    public function passwordAttributes(): array
    {
        return [
            'old_password' => 'Eski şifre',
            'new_password' => 'Yeni şifre',
        ];
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function updateSkills(Request $request): JsonResponse
    {
        $user = $request->user();

        // validator
        $validation = Validator::make(
            $request->all(),
            $this->skillRules(),
        );

        // if validation fails
        if ($validation->fails()) {
            return response()->json(['status' => 'error', 'data' => $validation->errors()]);
        }

        // validated data
        $data = array_map('intval', Arr::flatten($validation->validated()));

        // update skills
        $user->skills()->sync($data);

        // update crm
        event(new ProfileUpdated($user));

        return response()->json([
            'status' => 'success',
            'data' => 'Yetenekler başarıyla güncellenmiştir.',
            'send_data' => $data,
        ]);
    }

    /**
     * Get the validation rules that apply to the request for skills.
     *
     * @return array
     */
    public function skillRules(): array
    {
        return [
            'skills' => ['nullable', 'array'],
            'skills.*' => ['integer', 'exists:skills,id'],
        ];
    }
}
