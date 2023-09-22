<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Carbon;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Class Gallery
 *
 * @package App
 * @mixin Builder
 * @property int $id
 * @property string $galleryable_type
 * @property int $galleryable_id
 * @property string $gallery_url
 * @property int|null $gallery_added_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|array<Activity> $activities
 * @property-read int|null $activities_count
 * @property-read Model|Eloquent $galleryable
 * @method static Builder|Gallery newModelQuery()
 * @method static Builder|Gallery newQuery()
 * @method static Builder|Gallery query()
 * @method static Builder|Gallery whereCreatedAt($value)
 * @method static Builder|Gallery whereGalleryAddedBy($value)
 * @method static Builder|Gallery whereGalleryUrl($value)
 * @method static Builder|Gallery whereGalleryableId($value)
 * @method static Builder|Gallery whereGalleryableType($value)
 * @method static Builder|Gallery whereId($value)
 * @method static Builder|Gallery whereUpdatedAt($value)
 */
class Gallery extends Model
{
    use LogsActivity;

    protected static bool $logUnguarded = true;

    protected $guarded = [];

    public function galleryable(): MorphTo
    {
        return $this->morphTo();
    }
}
