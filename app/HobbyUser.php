<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * App\HobbyUser
 *
 * @property int $id
 * @property int $hobby_id
 * @property int $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|array<Activity> $activities
 * @property-read int|null $activities_count
 * @method static Builder|HobbyUser newModelQuery()
 * @method static Builder|HobbyUser newQuery()
 * @method static Builder|HobbyUser query()
 * @method static Builder|HobbyUser whereCreatedAt($value)
 * @method static Builder|HobbyUser whereHobbyId($value)
 * @method static Builder|HobbyUser whereId($value)
 * @method static Builder|HobbyUser whereUpdatedAt($value)
 * @method static Builder|HobbyUser whereUserId($value)
 * @mixin Builder
 */
class HobbyUser extends Model
{
    use LogsActivity;

    protected static bool $logUnguarded = true;
}
