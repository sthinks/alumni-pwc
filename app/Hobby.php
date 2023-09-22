<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Carbon;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Class Hobby
 *
 * @package App
 * @mixin Builder
 * @property int $id
 * @property string $hobby_title
 * @property string $hobby_abstract
 * @property string|null $hobby_seo_url
 * @property string $hobby_poster
 * @property string $hobby_description
 * @property string|null $hobby_responsible
 * @property string|null $hobby_responsible_avatar
 * @property string|null $hobby_responsible_role
 * @property int|null $hobby_edit_by
 * @property int $hobby_visible
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|array<Activity> $activities
 * @property-read int|null $activities_count
 * @property-read Collection|array<Event> $events
 * @property-read int|null $events_count
 * @property-read Collection|array<Media> $medias
 * @property-read int|null $medias_count
 * @property-read Collection|array<User> $users
 * @property-read int|null $users_count
 * @method static Builder|Hobby active()
 * @method static Builder|Hobby findSimilarSlugs(string $attribute, array $config, string $slug)
 * @method static Builder|Hobby newModelQuery()
 * @method static Builder|Hobby newQuery()
 * @method static Builder|Hobby query()
 * @method static Builder|Hobby whereCreatedAt($value)
 * @method static Builder|Hobby whereHobbyAbstract($value)
 * @method static Builder|Hobby whereHobbyDescription($value)
 * @method static Builder|Hobby whereHobbyEditBy($value)
 * @method static Builder|Hobby whereHobbyPoster($value)
 * @method static Builder|Hobby whereHobbyResponsible($value)
 * @method static Builder|Hobby whereHobbyResponsibleAvatar($value)
 * @method static Builder|Hobby whereHobbyResponsibleRole($value)
 * @method static Builder|Hobby whereHobbySeoUrl($value)
 * @method static Builder|Hobby whereHobbyTitle($value)
 * @method static Builder|Hobby whereHobbyVisible($value)
 * @method static Builder|Hobby whereId($value)
 * @method static Builder|Hobby whereUpdatedAt($value)
 */
class Hobby extends Model
{
    use LogsActivity;
    use Sluggable;

    protected static bool $logUnguarded = true;

    protected $guarded = [];

    /**
     * The users who have this hobby.
     *
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'hobby_users')->withTimestamps();
    }

    /**
     * One hobby can have many events
     *
     * @return BelongsToMany
     */
    public function events(): BelongsToMany
    {
        return $this->belongsToMany(Event::class, 'hobby_events')->withTimestamps();
    }

    /**
     * Get all of the medias for the hobby club.
     */
    public function medias(): MorphToMany
    {
        return $this
            ->morphToMany(Media::class, 'mediaable')
            ->withTimestamps();
    }

    /**
     * Scope a query to only include active clubs
     *
     * @param Builder $query
     *
     * @return Builder
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('hobby_visible', true);
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'hobby_seo_url' => [
                'source' => 'hobby_title',
            ],
        ];
    }
}
