<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Class Event
 *
 * @package App
 * @mixin Builder
 * @property int $id
 * @property string $event_title
 * @property string $event_abstract
 * @property string|null $event_seo_url
 * @property string $event_poster
 * @property string|null $event_description
 * @property int|null $event_city
 * @property string|null $event_venue
 * @property int|null $event_capacity
 * @property int $event_is_private
 * @property int $event_is_visible
 * @property Carbon|null $event_start_date
 * @property Carbon|null $event_end_date
 * @property Carbon|null $event_last_apply_date
 * @property int|null $event_edit_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|array<Activity> $activities
 * @property-read int|null $activities_count
 * @property-read Collection|array<User> $guests
 * @property-read int|null $guests_count
 * @property-read Collection|array<Hobby> $hobbies
 * @property-read int|null $hobbies_count
 * @property-read City|null $location
 * @property-read Collection|array<User> $users
 * @property-read int|null $users_count
 * @method static Builder|Event active()
 * @method static Builder|Event findSimilarSlugs(string $attribute, array $config, string $slug)
 * @method static Builder|Event future()
 * @method static Builder|Event lastApplyDateValid()
 * @method static Builder|Event newModelQuery()
 * @method static Builder|Event newQuery()
 * @method static Builder|Event past()
 * @method static Builder|Event private ()
 * @method static Builder|Event public ()
 * @method static Builder|Event query()
 * @method static Builder|Event whereCreatedAt($value)
 * @method static Builder|Event whereEventAbstract($value)
 * @method static Builder|Event whereEventCapacity($value)
 * @method static Builder|Event whereEventCity($value)
 * @method static Builder|Event whereEventDescription($value)
 * @method static Builder|Event whereEventEditBy($value)
 * @method static Builder|Event whereEventEndDate($value)
 * @method static Builder|Event whereEventIsPrivate($value)
 * @method static Builder|Event whereEventIsVisible($value)
 * @method static Builder|Event whereEventLastApplyDate($value)
 * @method static Builder|Event whereEventPoster($value)
 * @method static Builder|Event whereEventSeoUrl($value)
 * @method static Builder|Event whereEventStartDate($value)
 * @method static Builder|Event whereEventTitle($value)
 * @method static Builder|Event whereEventVenue($value)
 * @method static Builder|Event whereId($value)
 * @method static Builder|Event whereUpdatedAt($value)
 */
class Event extends Model
{
    use LogsActivity;
    use Sluggable;

    protected static bool $logUnguarded = true;

    protected $guarded = [];

    protected $casts = [
        'event_last_apply_date' => 'datetime',
        'event_start_date' => 'datetime',
        'event_end_date' => 'datetime',
        'event_private_users' => 'array',
    ];

    /**
     * @return HasOne
     */
    public function location(): HasOne
    {
        return $this->hasOne(City::class, 'id', 'event_city');
    }

    /**
     * One event can belongs to many hobby clubs
     *
     * @return BelongsToMany
     */
    public function hobbies(): BelongsToMany
    {
        return $this->belongsToMany(Hobby::class, 'hobby_events')->withTimestamps();
    }

    /**
     * Private event have invited users
     *
     * @return BelongsToMany
     */
    public function guests(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'event_guests')->withTimestamps();
    }

    /**
     * Scope a query to only include future events
     *
     * @param Builder $query
     *
     * @return Builder
     */
    public function scopeFuture(Builder $query): Builder
    {
        return $query->where('event_start_date', '>=', now());
    }

    /**
     * Scope a query to only include active events
     *
     * @param Builder $query
     *
     * @return Builder
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('event_is_visible', true);
    }

    /**
     * Events which still has capacity
     */
    public function hasCapacity(): bool
    {
        return $this->event_capacity > $this->users()->count();
    }

    /**
     * The users that belong to the campaign.
     *
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'event_users')
            ->withTimestamps()
            ->withPivot('event_ticket');
    }

    /**
     * Last apply date is still valid
     *
     * @param Builder $query
     *
     * @return Builder
     */
    public function scopeLastApplyDateValid(Builder $query): Builder
    {
        return $query->where('event_last_apply_date', '>=', now());
    }

    /**
     * Scope a query to only include past events
     *
     * @param Builder $query
     *
     * @return Builder
     */
    public function scopePast(Builder $query): Builder
    {
        return $query->where('event_start_date', '<=', now());
    }

    /**
     * Scope a query to only include past events
     *
     * @param Builder $query
     *
     * @return Builder
     */
    public function scopePrivate(Builder $query): Builder
    {
        return $query->where('event_is_private', true);
    }

    /**
     * Scope a query to only include public events
     *
     * @param Builder $query
     *
     * @return Builder
     */
    public function scopePublic(Builder $query): Builder
    {
        return $query->where('event_is_private', false);
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'event_seo_url' => [
                'source' => 'event_title',
            ],
        ];
    }
}
