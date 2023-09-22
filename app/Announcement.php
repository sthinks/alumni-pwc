<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Class Announcement
 *
 * @package App
 * @mixin Builder
 * @property int $id
 * @property int $announcement_category_id
 * @property string $announcement_title
 * @property string|null $announcement_abstract
 * @property string $announcement_seo_url
 * @property string|null $announcement_poster
 * @property string|null $announcement_text
 * @property string|null $announcement_link
 * @property int $announcement_is_visible
 * @property int|null $announcement_edit_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|array<Activity> $activities
 * @property-read int|null $activities_count
 * @property-read AnnouncementCategory $category
 * @method static Builder|Announcement active()
 * @method static Builder|Announcement findSimilarSlugs(string $attribute, array $config, string $slug)
 * @method static Builder|Announcement newModelQuery()
 * @method static Builder|Announcement newQuery()
 * @method static Builder|Announcement query()
 * @method static Builder|Announcement whereAnnouncementAbstract($value)
 * @method static Builder|Announcement whereAnnouncementCategoryId($value)
 * @method static Builder|Announcement whereAnnouncementEditBy($value)
 * @method static Builder|Announcement whereAnnouncementIsVisible($value)
 * @method static Builder|Announcement whereAnnouncementLink($value)
 * @method static Builder|Announcement whereAnnouncementPoster($value)
 * @method static Builder|Announcement whereAnnouncementSeoUrl($value)
 * @method static Builder|Announcement whereAnnouncementText($value)
 * @method static Builder|Announcement whereAnnouncementTitle($value)
 * @method static Builder|Announcement whereCreatedAt($value)
 * @method static Builder|Announcement whereId($value)
 * @method static Builder|Announcement whereUpdatedAt($value)
 */
class Announcement extends Model
{
    use LogsActivity;
    use Sluggable;

    protected static bool $logUnguarded = true;

    protected $guarded = [];

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(AnnouncementCategory::class, 'announcement_category_id');
    }

    /**
     * Announcement is active scope
     */
    public function scopeActive($query)
    {
        return $query->where('announcement_is_visible', true);
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'announcement_seo_url' => [
                'source' => 'announcement_title',
            ],
        ];
    }
}
