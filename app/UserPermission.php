<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\UserPermission
 *
 * @property int $id
 * @property int $user_id
 * @property int $permission_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|UserPermission newModelQuery()
 * @method static Builder|UserPermission newQuery()
 * @method static Builder|UserPermission query()
 * @method static Builder|UserPermission whereCreatedAt($value)
 * @method static Builder|UserPermission whereId($value)
 * @method static Builder|UserPermission wherePermissionId($value)
 * @method static Builder|UserPermission whereUpdatedAt($value)
 * @method static Builder|UserPermission whereUserId($value)
 * @mixin Builder
 */
class UserPermission extends Model
{
}
