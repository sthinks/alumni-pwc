<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * App\PwcSublos
 *
 * @property int $id
 * @property string $name
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|array<Activity> $activities
 * @property-read int|null $activities_count
 * @property-read Collection|array<User> $users
 * @property-read int|null $users_count
 * @method static Builder|PwcSublos newModelQuery()
 * @method static Builder|PwcSublos newQuery()
 * @method static Builder|PwcSublos query()
 * @method static Builder|PwcSublos whereCreatedAt($value)
 * @method static Builder|PwcSublos whereId($value)
 * @method static Builder|PwcSublos whereName($value)
 * @mixin Builder
 * @property int|null $pwc_los_id
 * @property-read \App\PwcLos|null $los
 * @method static Builder|PwcSublos wherePwcLosId($value)
 * @method static Builder|PwcSublos whereUpdatedAt($value)
 */
class PwcSublos extends Model
{
    use LogsActivity;

    protected static bool $logUnguarded = true;

    protected $table = 'pwc_sublos';
    protected $guarded = [];

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'pwc_worked_team_sublos', 'id');
    }

    public function los(): BelongsTo
    {
        return $this->belongsTo(PwcLos::class, 'pwc_los_id', 'id');
    }
}
