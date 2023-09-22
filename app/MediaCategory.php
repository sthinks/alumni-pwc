<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;

/**
 * App\MediaCategory
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|array<Media> $media
 * @property-read int|null $media_count
 * @method static Builder|MediaCategory newModelQuery()
 * @method static Builder|MediaCategory newQuery()
 * @method static Builder|MediaCategory query()
 * @method static Builder|MediaCategory whereCreatedAt($value)
 * @method static Builder|MediaCategory whereId($value)
 * @method static Builder|MediaCategory whereName($value)
 * @method static Builder|MediaCategory whereSlug($value)
 * @method static Builder|MediaCategory whereUpdatedAt($value)
 * @mixin Builder
 */
class MediaCategory extends Model
{
    protected $guarded = [];

    /**
     * The users who have this hobby.
     *
     * @return BelongsToMany
     */
    public function media(): BelongsToMany
    {
        return $this->belongsToMany(Media::class, 'media_category_places')->withTimestamps();
    }
}
