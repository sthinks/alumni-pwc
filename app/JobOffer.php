<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Class JobOffer
 *
 * @package App
 * @mixin Builder
 * @property int $id
 * @property int|null $job_owner_id
 * @property string|null $job_company
 * @property string $job_abstract
 * @property int $job_company_visible
 * @property string|null $job_title
 * @property string|null $job_seo_url
 * @property string|null $job_position
 * @property string|null $job_position_level
 * @property int|null $job_location
 * @property string|null $job_description
 * @property int|null $job_experience
 * @property string|null $job_apply_link
 * @property int $job_visible
 * @property int|null $job_edit_by
 * @property Carbon|null $job_valid_till
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|array<Activity> $activities
 * @property-read int|null $activities_count
 * @property-read City|null $location
 * @property-read Collection|array<User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|JobOffer active()
 * @method static \Illuminate\Database\Eloquent\Builder|JobOffer findSimilarSlugs(string $attribute, array $config, string $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|JobOffer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|JobOffer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|JobOffer query()
 * @method static \Illuminate\Database\Eloquent\Builder|JobOffer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobOffer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobOffer whereJobAbstract($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobOffer whereJobApplyLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobOffer whereJobCompany($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobOffer whereJobCompanyVisible($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobOffer whereJobDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobOffer whereJobEditBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobOffer whereJobExperience($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobOffer whereJobLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobOffer whereJobOwnerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobOffer whereJobPosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobOffer whereJobPositionLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobOffer whereJobSeoUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobOffer whereJobTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobOffer whereJobValidTill($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobOffer whereJobVisible($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobOffer whereUpdatedAt($value)
 */
class JobOffer extends Model
{
    use LogsActivity;
    use Sluggable;

    protected static bool $logUnguarded = true;
    protected $guarded = [];

    protected $casts = [
        'job_start_date' => 'datetime',
        'job_valid_till' => 'datetime',
    ];

    /**
     * The users that applied to this job
     *
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'job_offer_users')->withTimestamps();
    }

    /**
     * Job offer location
     *
     * @return HasOne
     */
    public function location(): HasOne
    {
        return $this->hasOne(City::class, 'id', 'job_location');
    }

    /**
     * Scope a query to only include active job offers
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive(\Illuminate\Database\Eloquent\Builder $query): \Illuminate\Database\Eloquent\Builder
    {
        return $query->where('job_visible', true);
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'job_seo_url' => [
                'source' => 'job_title',
            ],
        ];
    }
}
