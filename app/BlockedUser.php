<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\BlockedUser
 *
 * @property int $id
 * @property int $user_id
 * @property int $blocked_user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|BlockedUser newModelQuery()
 * @method static Builder|BlockedUser newQuery()
 * @method static Builder|BlockedUser query()
 * @method static Builder|BlockedUser whereBlockedUserId($value)
 * @method static Builder|BlockedUser whereCreatedAt($value)
 * @method static Builder|BlockedUser whereId($value)
 * @method static Builder|BlockedUser whereUpdatedAt($value)
 * @method static Builder|BlockedUser whereUserId($value)
 * @mixin Builder
 */
class BlockedUser extends Model
{
}
