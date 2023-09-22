<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Legacy
 *
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|array<User> $users
 * @property-read int|null $users_count
 * @method static Builder|Legacy newModelQuery()
 * @method static Builder|Legacy newQuery()
 * @method static Builder|Legacy query()
 * @method static Builder|Legacy whereCreatedAt($value)
 * @method static Builder|Legacy whereId($value)
 * @method static Builder|Legacy whereName($value)
 * @method static Builder|Legacy whereUpdatedAt($value)
 * @mixin Builder
 */
class Legacy extends Model
{
    protected $fillable = ['name'];

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'legacy', 'id');
    }
}
