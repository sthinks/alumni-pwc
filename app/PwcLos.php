<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * App\PwcLos
 *
 * @property int $id
 * @property string $name
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|array<Activity> $activities
 * @property-read int|null $activities_count
 * @property-read Collection|array<User> $users
 * @property-read int|null $users_count
 * @method static Builder|PwcLos newModelQuery()
 * @method static Builder|PwcLos newQuery()
 * @method static Builder|PwcLos query()
 * @method static Builder|PwcLos whereCreatedAt($value)
 * @method static Builder|PwcLos whereId($value)
 * @method static Builder|PwcLos whereName($value)
 * @mixin Builder
 * @property-read Collection|PwcLos[] $sublos
 * @property-read int|null $sublos_count
 * @method static Builder|PwcLos whereUpdatedAt($value)
 */
class PwcLos extends Model
{
    use LogsActivity;

    protected static bool $logUnguarded = true;
    protected $table = 'pwc_los';
    protected $guarded = [];

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'pwc_worked_team_los', 'id');
    }

    public function sublos(): HasMany
    {
        return $this->hasMany(PwcLos::class, 'id', 'pwc_los_id');
    }
}
