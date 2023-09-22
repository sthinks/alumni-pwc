<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\PwcOffice
 *
 * @property int $id
 * @property string $name
 * @property Carbon $created_at
 * @property-read Collection|array<User> $users
 * @property-read int|null $users_count
 * @method static Builder|PwcOffice newModelQuery()
 * @method static Builder|PwcOffice newQuery()
 * @method static Builder|PwcOffice query()
 * @method static Builder|PwcOffice whereCreatedAt($value)
 * @method static Builder|PwcOffice whereId($value)
 * @method static Builder|PwcOffice whereName($value)
 * @mixin Builder
 * @property Carbon|null $updated_at
 * @method static Builder|PwcOffice whereUpdatedAt($value)
 */
class PwcOffice extends Model
{
    protected $table = 'pwc_offices';

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'id', 'pwc_worked_office');
    }
}
