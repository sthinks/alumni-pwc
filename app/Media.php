<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Carbon;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Class Media
 *
 * @package App
 * @mixin Builder
 * @property int $id
 * @property string $media_title
 * @property string $media_abstract
 * @property string $media_seo_url
 * @property string|null $media_poster
 * @property string|null $media_description
 * @property string|null $media_embed
 * @property int $media_is_visible
 * @property int|null $media_edit_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|array<Activity> $activities
 * @property-read int|null $activities_count
 * @property-read Collection|array<MediaCategory> $categories
 * @property-read int|null $categories_count
 * @property-read Collection|array<Gallery> $files
 * @property-read int|null $files_count
 * @property-read Collection|array<Hobby> $hobbies
 * @property-read int|null $hobbies_count
 * @method static Builder|Media active()
 * @method static Builder|Media findSimilarSlugs(string $attribute, array $config, string $slug)
 * @method static Builder|Media newModelQuery()
 * @method static Builder|Media newQuery()
 * @method static Builder|Media query()
 * @method static Builder|Media whereCreatedAt($value)
 * @method static Builder|Media whereId($value)
 * @method static Builder|Media whereMediaAbstract($value)
 * @method static Builder|Media whereMediaDescription($value)
 * @method static Builder|Media whereMediaEditBy($value)
 * @method static Builder|Media whereMediaEmbed($value)
 * @method static Builder|Media whereMediaIsVisible($value)
 * @method static Builder|Media whereMediaPoster($value)
 * @method static Builder|Media whereMediaSeoUrl($value)
 * @method static Builder|Media whereMediaTitle($value)
 * @method static Builder|Media whereUpdatedAt($value)
 */
class Media extends Model
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
    public function categories(): BelongsToMany
    {
        return $this
            ->belongsToMany(MediaCategory::class, 'media_category_places')
            ->withTimestamps();
    }

    /**
     * Get all the medias that are assigned this media.
     */
    public function hobbies(): MorphToMany
    {
        return $this->morphedByMany(Hobby::class, 'mediaable')
            ->withTimestamps();
    }

    /**
     * Scope only active contents
     *
     * @param $query
     *
     * @return Builder
     */
    public function scopeActive($query): Builder
    {
        return $query->where('media_is_visible', '=', true);
    }

    /**
     * A media can have many files
     *
     * @return MorphMany
     */
    public function files(): MorphMany
    {
        return $this->morphMany(Gallery::class, 'galleryable');
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'media_seo_url' => [
                'source' => 'media_title',
            ],
        ];
    }
}
