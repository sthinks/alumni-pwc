<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * App\Slider
 *
 * @mixin Builder
 * @property int $id
 * @property string $slider_topic
 * @property string|null $slider_title
 * @property string $slider_desc
 * @property string $slider_image
 * @property string|null $slider_link
 * @property int $slider_visible
 * @property int $slider_order
 * @property int|null $slider_edit_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|array<Activity> $activities
 * @property-read int|null $activities_count
 * @method static Builder|Slider active()
 * @method static Builder|Slider newModelQuery()
 * @method static Builder|Slider newQuery()
 * @method static Builder|Slider query()
 * @method static Builder|Slider whereCreatedAt($value)
 * @method static Builder|Slider whereId($value)
 * @method static Builder|Slider whereSliderDesc($value)
 * @method static Builder|Slider whereSliderEditBy($value)
 * @method static Builder|Slider whereSliderImage($value)
 * @method static Builder|Slider whereSliderLink($value)
 * @method static Builder|Slider whereSliderOrder($value)
 * @method static Builder|Slider whereSliderTitle($value)
 * @method static Builder|Slider whereSliderTopic($value)
 * @method static Builder|Slider whereSliderVisible($value)
 * @method static Builder|Slider whereUpdatedAt($value)
 */
class Slider extends Model
{
    use LogsActivity;

    protected static bool $logUnguarded = true;
    protected $guarded = [];

    /**
     * Scope a query to only include active sliders
     *
     * @param Builder $query
     *
     * @return Builder
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('slider_visible', true);
    }
}
