<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\CampaignCategory
 *
 * @property int $id
 * @property string|null $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|CampaignCategory newModelQuery()
 * @method static Builder|CampaignCategory newQuery()
 * @method static Builder|CampaignCategory query()
 * @method static Builder|CampaignCategory whereCreatedAt($value)
 * @method static Builder|CampaignCategory whereId($value)
 * @method static Builder|CampaignCategory whereName($value)
 * @method static Builder|CampaignCategory whereUpdatedAt($value)
 * @mixin Builder
 */
class CampaignCategory extends Model
{
    protected $guarded = [];
}
