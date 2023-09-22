<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\CampaignUser
 *
 * @property int $id
 * @property int $campaign_id
 * @property int $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|CampaignUser newModelQuery()
 * @method static Builder|CampaignUser newQuery()
 * @method static Builder|CampaignUser query()
 * @method static Builder|CampaignUser whereCampaignId($value)
 * @method static Builder|CampaignUser whereCreatedAt($value)
 * @method static Builder|CampaignUser whereId($value)
 * @method static Builder|CampaignUser whereUpdatedAt($value)
 * @method static Builder|CampaignUser whereUserId($value)
 * @mixin Builder
 */
class CampaignUser extends Model
{
    protected $guarded = [];
}
