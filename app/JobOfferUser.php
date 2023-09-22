<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\JobOfferUser
 *
 * @property int $id
 * @property int $job_offer_id
 * @property int $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|JobOfferUser newModelQuery()
 * @method static Builder|JobOfferUser newQuery()
 * @method static Builder|JobOfferUser query()
 * @method static Builder|JobOfferUser whereCreatedAt($value)
 * @method static Builder|JobOfferUser whereId($value)
 * @method static Builder|JobOfferUser whereJobOfferId($value)
 * @method static Builder|JobOfferUser whereUpdatedAt($value)
 * @method static Builder|JobOfferUser whereUserId($value)
 * @mixin Builder
 */
class JobOfferUser extends Model
{
    protected $guarded = [];
}
