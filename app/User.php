<?php

namespace App;

use App\Helpers\StrHelper;
use App\Mail\BusinessMail;
use App\Notifications\ResetUserPassword;
use App\Notifications\TwoFactorAuth;
use App\Notifications\VerifyUserEmailNotification;
use App\Notifications\VerifyUserPhone;
use Exception;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Spatie\Activitylog\Models\Activity;
use Yadahan\AuthenticationLog\AuthenticationLog;
use Yadahan\AuthenticationLog\AuthenticationLogable;

/**
 * App\User
 *
 * @mixin Builder
 * @property int $id
 * @property string $uid
 * @property string|null $staff_id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string|null $linkedin
 * @property string|null $phone_verify_code
 * @property string $password
 * @property string $user_type
 * @property int $is_approved
 * @property Carbon|null $approved_at
 * @property int|null $approved_by
 * @property int $is_active
 * @property string|null $remember_token
 * @property Carbon|null $birthdate
 * @property string|null $phone_verified_at
 * @property Carbon|null $phone_verify_code_expires_at
 * @property Carbon|null $pwc_join_year
 * @property Carbon|null $email_verified_at
 * @property Carbon|null $created_at
 * @property string|null $clarification_text
 * @property string|null $user_agreement
 * @property Carbon|null $updated_at
 * @property string|null $two_factor_code
 * @property Carbon|null $two_factor_expires_at
 * @property string|null $second_surname
 * @property string $avatar
 * @property string|null $second_mail
 * @property Carbon|null $second_mail_verified_at
 * @property string|null $home_address
 * @property string|null $university
 * @property int|null $legacy
 * @property Carbon|null $pwc_quit_year
 * @property int|null $pwc_worked_office
 * @property int|null $pwc_worked_team_los
 * @property int|null $pwc_worked_team_sublos
 * @property string|null $current_work_sector
 * @property string|null $current_work_company
 * @property string|null $current_work_role
 * @property-read Collection|array<AuthenticationLog> $authentications
 * @property-read int|null $authentications_count
 * @property-read Collection|array<User> $blocked
 * @property-read int|null $blocked_count
 * @property-read Collection|array<Campaign> $campaigns
 * @property-read int|null $campaigns_count
 * @property-read Collection|array<Contact> $contactForms
 * @property-read int|null $contact_forms_count
 * @property-read Collection|array<Event> $events
 * @property-read int|null $events_count
 * @property-read Collection|array<Hobby> $hobbies
 * @property-read int|null $hobbies_count
 * @property-read Collection|array<JobOffer> $jobOffers
 * @property-read int|null $job_offers_count
 * @property-read DatabaseNotificationCollection|array<DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read Collection|array<PasswordHistory> $passwordHistory
 * @property-read int|null $password_history_count
 * @property-read Collection|array<Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read Collection|array<Event> $privateEvents
 * @property-read int|null $private_events_count
 * @property-read Legacy|null $pwcLegacy
 * @property-read PwcOffice|null $pwcWorkedOffice
 * @property-read PwcLos|null $pwcWorkedTeamLos
 * @property-read PwcSublos|null $pwcWorkedTeamSubLos
 * @property-read Collection|array<JobShare> $sharedJobs
 * @property-read int|null $shared_jobs_count
 * @method static Builder|User alumni()
 * @method static Builder|User approved()
 * @method static Builder|User newModelQuery()
 * @method static Builder|User newQuery()
 * @method static Builder|User query()
 * @method static Builder|User whereApprovedAt($value)
 * @method static Builder|User whereApprovedBy($value)
 * @method static Builder|User whereAvatar($value)
 * @method static Builder|User whereBirthdate($value)
 * @method static Builder|User whereClarificationText($value)
 * @method static Builder|User whereCreatedAt($value)
 * @method static Builder|User whereCurrentWorkCompany($value)
 * @method static Builder|User whereCurrentWorkRole($value)
 * @method static Builder|User whereCurrentWorkSector($value)
 * @method static Builder|User whereEmail($value)
 * @method static Builder|User whereEmailVerifiedAt($value)
 * @method static Builder|User whereHomeAddress($value)
 * @method static Builder|User whereId($value)
 * @method static Builder|User whereIsActive($value)
 * @method static Builder|User whereIsApproved($value)
 * @method static Builder|User whereLegacy($value)
 * @method static Builder|User whereLinkedin($value)
 * @method static Builder|User whereName($value)
 * @method static Builder|User wherePassword($value)
 * @method static Builder|User wherePhone($value)
 * @method static Builder|User wherePhoneVerifiedAt($value)
 * @method static Builder|User wherePhoneVerifyCode($value)
 * @method static Builder|User wherePhoneVerifyCodeExpiresAt($value)
 * @method static Builder|User wherePwcJoinYear($value)
 * @method static Builder|User wherePwcQuitYear($value)
 * @method static Builder|User wherePwcWorkedOffice($value)
 * @method static Builder|User wherePwcWorkedTeamLos($value)
 * @method static Builder|User wherePwcWorkedTeamSublos($value)
 * @method static Builder|User whereRememberToken($value)
 * @method static Builder|User whereSecondMail($value)
 * @method static Builder|User whereSecondMailVerifiedAt($value)
 * @method static Builder|User whereSecondSurname($value)
 * @method static Builder|User whereSkills($value)
 * @method static Builder|User whereStaffId($value)
 * @method static Builder|User whereTwoFactorCode($value)
 * @method static Builder|User whereTwoFactorExpiresAt($value)
 * @method static Builder|User whereUid($value)
 * @method static Builder|User whereUniversity($value)
 * @method static Builder|User whereUpdatedAt($value)
 * @method static Builder|User whereUserAgreement($value)
 * @method static Builder|User whereUserType($value)
 * @property-read Collection|\App\Skill[] $skills
 * @property-read int|null $skills_count
 * @property int|null $role_id
 * @method static Builder|User whereRoleId($value)
 * @property-read Collection|\App\UserTerm[] $termAndConditions
 * @property-read int|null $term_and_conditions_count
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use AuthenticationLogable;
    use Notifiable;

    protected static bool $logUnguarded = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'staff_id', 'name', 'email', 'password', 'phone', 'birthdate', 'pwc_join_year', 'linkedin',
        'two_factor_code', 'two_factor_expires_at',
        'is_approved', 'approved_at', 'approved_by', 'user_type',
        'second_surname', 'avatar', 'second_mail', 'second_mail_verified_at', 'home_address',
        'hobbies', 'university', 'legacy', 'pwc_quit_year',
        'pwc_worked_team_los', 'pwc_worked_team_sublos', 'pwc_worked_office',
        'current_work_company', 'current_work_role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'birthdate' => 'datetime',
        'pwc_join_year' => 'datetime',
        'two_factor_expires_at' => 'datetime',
        'phone_verify_code_expires_at' => 'datetime',
        'second_mail_verified_at' => 'datetime',
        'pwc_quit_year' => 'datetime',
        'approved_at' => 'datetime',
        'user_agreement' => 'datetime:d/m/Y H:i:s',
        'clarification_text' => 'datetime:d/m/Y H:i:s',
    ];

    /**
     * Check if user has verified phone number
     *
     * @return bool
     */
    public function hasVerifiedPhone(): bool
    {
        return ! is_null($this->phone_verified_at);
    }

    /**
     * User has verified number
     *
     * @return bool
     */
    public function markPhoneAsVerified(): bool
    {
        return $this->forceFill([
            'phone_verified_at' => $this->freshTimestamp(),
        ])->save();
    }

    /**
     * Generates two-factor code
     */
    public function generateTwoFactorCode()
    {
        $this->timestamps = false;
        try {
            $this->two_factor_code = random_int(100000, 999999);
        } catch (Exception $e) {
            $this->two_factor_code = mt_rand(100000, 999999);
        }
        $this->two_factor_expires_at = now()->addMinutes(2);
        $this->save();
    }

    /**
     * Sends two factor code to the user via sms
     *
     * @return void
     */
    public function sendTwoFactorCode()
    {
        $this->notify(new TwoFactorAuth());
    }

    /**
     * This resets two-factor code
     */
    public function resetTwoFactorCode()
    {
        $this->timestamps = false;
        $this->two_factor_code = null;
        $this->two_factor_expires_at = null;
        $this->save();
    }

    /**
     * Generates phone verification code
     */
    public function generateVerificationCode()
    {
        $this->timestamps = false;
        try {
            $this->phone_verify_code = random_int(100000, 999999);
        } catch (Exception $e) {
            $this->phone_verify_code = mt_rand(100000, 999999);
        }
        $this->phone_verify_code_expires_at = now()->addMinutes(2);
        $this->save();
    }

    /**
     * Sends verification code to the user via sms
     *
     * @returns void
     */
    public function sendVerificationCode()
    {
        $this->notify(new VerifyUserPhone());
    }

    /**
     * This resets verification code
     */
    public function resetVerificationCode()
    {
        $this->timestamps = false;
        $this->phone_verify_code = null;
        $this->phone_verify_code_expires_at = null;
        $this->save();
    }

    /**
     * Determines if this user admin approved
     */
    public function isApproved(): bool
    {
        return (bool) $this->is_approved;
    }

    /**
     * Scope a query to only include approved users.
     *
     * @param Builder $query
     *
     * @return Builder
     */
    public function scopeApproved(Builder $query): Builder
    {
        return $query->where('is_approved', '=', 1);
    }

    /**
     * Scope a query to only include approved users.
     *
     * @param Builder $query
     *
     * @return Builder
     */
    public function scopeAlumni(Builder $query): Builder
    {
        return $query->where('is_approved', '=', 1)->where('user_type', '=', 'alumni');
    }

    /**
     * Sends the password reset notification.
     *
     * @param string $token
     *
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetUserPassword($token));
    }

    /**
     * The campaigns that user joined
     *
     * @return BelongsToMany
     */
    public function campaigns(): BelongsToMany
    {
        return $this->belongsToMany(Campaign::class, 'campaign_users')->withTimestamps();
    }

    /**
     * The term and conditions user approved
     *
     * @return BelongsToMany
     */
    public function termAndConditions(): BelongsToMany
    {
        return $this->belongsToMany(TermCondition::class, 'user_terms')->withTimestamps();
    }

    /**
     * The job offer that user applied
     *
     * @return BelongsToMany
     */
    public function jobOffers(): BelongsToMany
    {
        return $this->belongsToMany(JobOffer::class, 'job_offer_users')->withTimestamps();
    }

    /**
     * The hobby clubs that user joined
     *
     * @return BelongsToMany
     */
    public function hobbies(): BelongsToMany
    {
        return $this->belongsToMany(Hobby::class, 'hobby_users')->withTimestamps();
    }

    /**
     * The events that user joined
     */
    public function events(): BelongsToMany
    {
        return $this->belongsToMany(Event::class, 'event_users')->withTimestamps();
    }

    /**
     * Send second mail verification
     *
     * @return void
     *
     * @throws Exception
     */
    public function sendSecondEmailVerificationNotification()
    {
        // Generate a unique token
        $uniqueToken = sprintf('%s-%s', Str::random(), md5($this->id . $this->email . $this->phone));

        // Delete old records
        SecondMailVerify::where('user_id', $this->id)->delete();

        // Save new token on the database
        SecondMailVerify::create([
            'user_id' => $this->id,
            'token' => $uniqueToken,
        ]);

        // Send email
        Mail::send(new BusinessMail($this, $uniqueToken));
    }

    /**
     * Check if user has verified second mail address
     *
     * @return bool
     */
    public function hasVerifiedSecondMail(): bool
    {
        return ! is_null($this->second_mail_verified_at);
    }

    /**
     * Private events that user got invited
     *
     * @return BelongsToMany
     */
    public function privateEvents(): BelongsToMany
    {
        return $this->belongsToMany(Event::class, 'event_guests')->withTimestamps();
    }

    /**
     * Skills user got
     *
     * @return BelongsToMany
     */
    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class, 'user_skills')->withTimestamps();
    }

    /**
     * A user can share many jobs
     *
     * @return HasMany
     */
    public function sharedJobs(): HasMany
    {
        return $this->hasMany(JobShare::class);
    }

    /**
     * An user can block another user
     *
     * @return void
     */
    public function blockUser(User $user)
    {
        // block if user not blocked before
        if (! $this->checkIfUserBlocked($user)) {
            $this->blocked()->attach($user->id);
        }
    }

    /**
     * Check if this user blocked a user
     *
     * @param User $user
     *
     * @return bool
     */
    public function checkIfUserBlocked(User $user): bool
    {
        return $this->blocked->contains($user);
    }

    /**
     * A user can have many blocked users
     *
     * @return belongsToMany
     */
    public function blocked(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'blocked_users', 'user_id', 'blocked_user_id');
    }

    /**
     * A user can unblock previously blocked user
     *
     * @return void
     */
    public function unblockUser(User $user)
    {
        // unblock if user blocked before
        if ($this->checkIfUserBlocked($user)) {
            $this->blocked()->detach($user->id);
        }
    }


    /**
     * User permissions
     *
     * @returns BelongsToMany
     */
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'user_permissions')->withTimestamps();
    }

    /**
     * Get user masked number
     *
     * @return string
     */
    public function maskedPhone(): string
    {
        return StrHelper::maskPhone($this->phone);
    }

    /**
     * User need to change password
     *
     * @return bool
     */
    public function isPasswordExpired(): bool
    {
        // default value
        $password_expires_in = 90;
        if ($this->isAdmin()) {
            $password_expires_in = config('auth.password_expires_in.admin');
        } elseif ($this->isAlumni()) {
            $password_expires_in = config('auth.password_expires_in.alumni');
        }
        // get last password
        $lastPasswords = $this->passwordHistory()->get();

        // if password is expired
        return $lastPasswords->last()->created_at->addDays($password_expires_in)->isPast();
    }

    /**
     * Determines if this user is admin
     */
    public function isAdmin(): bool
    {
        return $this->user_type === 'admin';
    }

    /**
     * Determines if this user is admin
     */
    public function isAlumni(): bool
    {
        return $this->user_type === 'alumni';
    }

    /**
     * User password history
     *
     * @return HasMany
     */
    public function passwordHistory(): HasMany
    {
        return $this->hasMany(PasswordHistory::class);
    }

    /**
     * Get user failed logins
     */
    public function failedLogins()
    {
        return Activity::where('description', config('activitylog.auth_logs.failed_login'))
            ->where('subject_id', $this->id)
            ->get();
    }

    /**
     * Get contact form user created
     *
     * @return HasMany
     */
    public function contactForms(): HasMany
    {
        return $this->hasMany(Contact::class);
    }

    /**
     * Profile filling rate
     *
     * @return float
     */
    public function getFillingRate()
    {
        // number of null fields
        $null = 0;

        // number of total fields to be filled
        $number_of_fields = 0;

        // this fields are fillable
        // but not by users intentionally
        $notCount = [
            'password',
            'staff_id',
            'two_factor_code',
            'two_factor_expires_at',
            'is_approved',
            'approved_at',
            'approved_by',
            'user_type',
            'second_surname',
            'second_mail_verified_at',
        ];
        // get all fields
        foreach ($this->getFillable() as $value) {

            // exclude notCount fields
            if (! in_array($value, $notCount)) {

                // increment number of fields
                $number_of_fields++;

                // if field is null
                if ($this->$value === null && strlen($this->$value) < 1) {
                    // increment null fields
                    $null++;
                }
            }
        }
        // return filling rate
        $rate = $number_of_fields > 0 ? 100 - ($null / $number_of_fields) * 100 : 0;
        return (int) floor($rate);
    }

    /**
     * Extract first name from full name
     *
     * @return string
     */
    public function getFirstName(): string
    {
        return StrHelper::splitName($this->name);
    }

    /**
     * Extract surname from full name
     *
     * @return string
     */
    public function getSurname(): string
    {
        return StrHelper::splitName($this->name, 'surname');
    }

    /**
     * Get the office associated with the user.
     */
    public function pwcWorkedOffice(): BelongsTo
    {
        return $this->belongsTo(PwcOffice::class, 'pwc_worked_office', 'id');
    }

    /**
     * Get the office associated with the user.
     */
    public function pwcWorkedTeamLos(): BelongsTo
    {
        return $this->belongsTo(PwcLos::class, 'pwc_worked_team_los', 'id');
    }

    /**
     * Get the office associated with the user.
     */
    public function pwcWorkedTeamSubLos(): BelongsTo
    {
        return $this->belongsTo(PwcSublos::class, 'pwc_worked_team_sublos', 'id');
    }

    /**
     * Check for consent permissions
     *
     * @param string $consent
     * @return bool
     */
    public function consent(string $consent): bool
    {
        return $this->permissions()->where('slug', $consent)->count();
    }

    /**
     * Get the consent permissions
     *
     * @param string $consent
     * @return Permission
     */
    public function getConsent(string $consent): Permission
    {
        return $this->permissions()->where('slug', $consent)->first();
    }

    /**
     * Get the legacy
     */
    public function pwcLegacy(): BelongsTo
    {
        return $this->belongsTo(Legacy::class, 'legacy', 'id');
    }

    /**
     * Get the user's first name.
     *
     * @param string|null $value
     *
     * @return string
     */
    public function getAvatarAttribute(?string $value): string
    {
        $null_avatar = url(Config::get('constants.alumni.avatar'));
        return $value ? route('storage.images', $value) : $null_avatar;
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyUserEmailNotification());
    }
}
