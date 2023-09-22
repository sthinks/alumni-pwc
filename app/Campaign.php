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
 * Class Campaign
 *
 * @package App
 * @mixin Builder
 * @property int $id
 * @property string $campaign_title
 * @property int|null $campaign_category
 * @property string|null $campaign_company
 * @property string $campaign_abstract
 * @property string $campaign_text
 * @property string $campaign_poster
 * @property string $campaign_code
 * @property string|null $campaign_seo_url
 * @property int|null $campaign_limit
 * @property Carbon|null $campaign_end_date
 * @property int $campaign_visible
 * @property int $campaign_edit_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|array<Activity> $activities
 * @property-read int|null $activities_count
 * @property-read CampaignCategory|null $category
 * @property-read Collection|array<User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Campaign active()
 * @method static \Illuminate\Database\Eloquent\Builder|Campaign findSimilarSlugs(string $attribute, array $config, string $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|Campaign future()
 * @method static \Illuminate\Database\Eloquent\Builder|Campaign newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Campaign newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Campaign query()
 * @method static \Illuminate\Database\Eloquent\Builder|Campaign whereCampaignAbstract($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Campaign whereCampaignCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Campaign whereCampaignCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Campaign whereCampaignCompany($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Campaign whereCampaignEditBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Campaign whereCampaignEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Campaign whereCampaignLimit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Campaign whereCampaignPoster($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Campaign whereCampaignSeoUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Campaign whereCampaignText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Campaign whereCampaignTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Campaign whereCampaignVisible($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Campaign whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Campaign whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Campaign whereUpdatedAt($value)
 */
class Campaign extends Model
{
    use LogsActivity;
    use Sluggable;

    protected static bool $logUnguarded = true;

    protected $guarded = [];

    protected $casts = [
        'campaign_end_date' => 'datetime',
    ];

    /**
     * The users that belong to the campaign.
     *
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'campaign_users')->withTimestamps();
    }

    /**
     * Set the campaign visible value
     *
     * @param string $value
     *
     * @return void
     */
    public function setCampaignVisibleAttribute(string $value)
    {
        $this->attributes['campaign_visible'] = (bool) $value;
    }

    /**
     * Get category of the offer
     *
     * @return HasOne
     */
    public function category(): HasOne
    {
        return $this->hasOne(CampaignCategory::class, 'id', 'campaign_category');
    }

    /**
     * Check if campaign is visible
     */
    public function scopeActive($query)
    {
        return $query->where('campaign_visible', true);
    }

    /**
     * Campaigns which didn't expire yet
     */
    public function scopeFuture($query)
    {
        return $query->where('campaign_end_date', '>=', now());
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'campaign_seo_url' => [
                'source' => 'campaign_title',
            ],
        ];
    }
}
